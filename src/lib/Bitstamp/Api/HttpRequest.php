<?php
namespace Bitstamp\Api;

class HttpRequest
{

    const METHOD_GET = "GET";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_DELETE = "DELETE";

    /**
     * @param  string $method
     * @param  string $uri
     * @param  array $data
     * @param  array $headers
     * @param  array $curl_options
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return \Bitstamp\Api\HttpResponse
     */
    public function send($method, $uri, array $data = [], array $headers = [], array $curl_options = [])
    {
        $data_string = null;

        if ( ! empty($data)) {
            $data_string = http_build_query($data);
        }

        $options = $this->cleanOptions($curl_options);

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

        $curl = curl_init();
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        if (false === $response) {

            $errno = curl_errno($curl);
            $message = curl_error($curl);
            curl_close($curl);

            throw new \RuntimeException("Failed to execute HTTP request: {$method} {$uri} ([{$errno}] {$message})");

        }

        $http_response = new \Bitstamp\Api\HttpResponse($curl, $response);

        curl_close($curl);

        return $http_response;
    }

    /**
     * Cleans up an array of options and applies user-level and default settings to global configuration.
     *
     * @param  array $user_options
     * @return array
     */
    protected function cleanOptions(array $user_options)
    {
        $options = (
            [
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true
            ]
            + $user_options
            + [
                CURLOPT_CONNECTTIMEOUT => 3,
                CURLOPT_HTTPHEADER => [],
                CURLOPT_SSL_VERIFYPEER => 1,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_TIMEOUT => 10
            ]
        );

        $disallowed_options = [
            CURLOPT_URL,
            CURLOPT_CUSTOMREQUEST,
            CURLOPT_POST,
            CURLOPT_POSTFIELDS
        ];

        foreach ($disallowed_options as $name) {
            if (array_key_exists($name, $options)) {
                unset($options[$name]);
            }
        }

        return $options;
    }

}
