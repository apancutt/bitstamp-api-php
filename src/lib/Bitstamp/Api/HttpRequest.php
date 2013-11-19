<?php
namespace Bitstamp\Api;

class HttpRequest
{

    private $logger;

    const METHOD_GET = "GET";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_DELETE = "DELETE";

    /**
     * @param \Bitstamp\Api\LoggerInterface $logger
     */
    public function __construct(\Bitstamp\Api\LoggerInterface $logger = null)
    {
        if (null !== $logger) {
            $this->setLogger($logger);
        }
    }

    /**
     * @return \Bitstamp\Api\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @return boolean
     */
    public function hasLogger()
    {
        return (null !== $this->getLogger());
    }

    /**
     * @param  \Bitstamp\Api\LoggerInterface $logger
     * @return \Bitstamp\Api\HttpRequest
     */
    protected function setLogger(\Bitstamp\Api\LoggerInterface $logger = null)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return \Bitstamp\Api\HttpRequest
     */
    protected function removeLogger()
    {
        return $this->setLogger(null);
    }

    /**
     * @param  string $method
     * @param  string $uri
     * @param  array $data
     * @param  array $headers
     * @param  array $options
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return \Bitstamp\Api\HttpResponse
     */
    public function send($method, $uri, array $data = [], array $headers = [], array $options = [])
    {
        $logger = $this->getLogger();

        $data_string = null;

        if ( ! empty($data)) {
            $data_string = http_build_query($data);
        }

        $this->cleanOptions($options);

        switch ($method) {

        	case static::METHOD_GET:
        	case static::METHOD_DELETE:
        	    if (null !== $data_string) {
        	        $uri .= "?{$data_string}";
        	    }
        	    break;

        	case static::METHOD_POST:
        	case static::METHOD_PUT:
        	    $options[CURLOPT_POSTFIELDS] = $data_string;
        	    $headers["Content-Length"] = mb_strlen($data_string);
        	    break;

        	default:
        	    throw new \InvalidArgumentException("Invalid request method: {$method}");

        }

        $options[CURLOPT_CUSTOMREQUEST] = $method;
        $options[CURLOPT_URL] = $uri;

        foreach ($headers as $name => $value) {
            $options[CURLOPT_HTTPHEADER][] = "{$name}: {$value}";
        }

        if (null !== $logger) {
            $logger->debug("Sending HTTP {$method} request to: {$uri}");
        }

        $curl = curl_init();
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        if (false === $response) {

            $errno = curl_errno($curl);
            $message = curl_error($curl);
            curl_close($curl);

            throw new \RuntimeException("Failed to execute HTTP request: {$method} {$uri} ([{$errno}] {$message})");

        }

        return $this->response($curl, $response);
    }

    /**
     * Process the raw response and return a HttpResponse instance.
     *
     * @param  resource $curl
     * @param  string   $response
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function response($curl, $response)
    {
        $logger = $this->getLogger();

        list($headers, $body) = preg_split("/(\r?\n){2}/", $response, 2);

        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $this
            ->cleanHeaders($curl, $headers)
            ->cleanBody($curl, $body);

        curl_close($curl);

        $http_response = new \Bitstamp\Api\HttpResponse($status_code, $headers, $body);

        if (null !== $logger) {
            $logger->debug("Response received (HTTP {$http_response->getStatusCode()})");
        }

        return $http_response;
    }

    /**
     * Cleans up an array of options and applies user-level and default settings to global configuration. The provided
     * argument is passed by reference to conserve memory.
     *
     * @param  array $options
     * @return \Bitstamp\Api\HttpRequest
     */
    protected function cleanOptions(array &$options)
    {
        $options = (

            // The following options are hard-coded and cannot be overridden
            [
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true
            ]

            // Apply the user-provided options
            + $options

            // Apply default values to required options
            + [
                CURLOPT_CONNECTTIMEOUT => 3,
                CURLOPT_HTTPHEADER => [],
                CURLOPT_SSL_VERIFYPEER => 1,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_TIMEOUT => 10
            ]

        );

        // Remove restricted options

        $restricted_options = [
            CURLOPT_URL,
            CURLOPT_CUSTOMREQUEST,
            CURLOPT_POST,
            CURLOPT_POSTFIELDS
        ];

        foreach ($restricted_options as $name) {
            if (array_key_exists($name, $options)) {
                unset($options[$name]);
            }
        }

        return $this;
    }

    /**
     * Extract the headers from a raw header string. The provided argument is passed by reference to conserve memory.
     *
     * @param  resource $curl
     * @param  string   $headers
     * @return \Bitstamp\Api\HttpRequest
     */
    protected function cleanHeaders($curl, &$headers)
    {
        $headers = preg_split("/\r?\n/", $headers);

        foreach ($headers as $header) {

            if (substr_count($header, ":") == 0) {
                continue;
            }

            list($name, $value) = preg_split("/\s*:\s*/", $header, 2);
            $headers[$name] = $value;

        }

        return $this;
    }

    /**
     * Extract the body content from a raw body string. The provided argument is passed by reference to conserve memory.
     *
     * @param  resource $curl
     * @param  string   $body
     * @return \Bitstamp\Api\HttpRequest
     */
    protected function cleanBody($curl, &$body)
    {
        $body = trim($body);

        if (mb_strlen($body) > 0) {

            $content_type = mb_strtolower(trim(explode(";", curl_getinfo($curl, CURLINFO_CONTENT_TYPE), 2)[0]));

            if ($content_type === "application/json") {
                $body = json_decode($body, true);
            }

        }

        return $this;
    }

}
