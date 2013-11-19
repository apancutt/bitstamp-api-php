<?php
namespace Bitstamp\Api;

class HttpResponse
{

    private $status_code;
    private $headers = [];
    private $body;

    /**
     * @param resource $curl
     * @param string   $response
     **/
    public function __construct($curl, $response)
    {
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headers = [];
        $body = null;

        list($raw_headers, $raw_body) = preg_split("/(\r?\n){2}/", $response, 2);

        foreach (preg_split("/\r?\n/", $raw_headers) as $header) {

            if (substr_count($header, ":") == 0) {
                continue;
            }

            list($name, $value) = preg_split("/\s*:\s*/", $header, 2);
            $headers[$name] = $value;

        }

        $raw_body = trim($raw_body);
        if (mb_strlen($raw_body) > 0) {

            $content_type = mb_strtolower(trim(explode(";", curl_getinfo($curl, CURLINFO_CONTENT_TYPE), 2)[0]));

            switch ($content_type) {

            	case "application/json":
            	    $body = json_decode($raw_body, true);
            	    break;

            	default:
                    $body = $raw_body;

            }

        }

        $this
            ->setStatusCode(curl_getinfo($curl, CURLINFO_HTTP_CODE))
            ->setAllHeaders($headers)
            ->setBody($body);
    }

    /**
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param  integer $status_code
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function setStatusCode($status_code)
    {
        $this->status_code = (int) $status_code;

        return $this;
    }

    /**
     * @param  string $name
     * @return string
     */
    public function getHeader($name)
    {
        return $this->hasHeader($name) ? $this->headers[$name] : null;
    }

    /**
     * @return array
     */
    public function getAllHeaders()
    {
        return $this->headers;
    }

    /**
     * @param  string $name
     * @return boolean
     */
    public function hasHeader($name)
    {
        return array_key_exists($name, $this->getAllHeaders());
    }

    /**
     * @return boolean
     */
    public function hasAnyHeaders()
    {
        return (count($this->getAllHeaders()) > 0);
    }

    /**
     * @param  string $name
     * @param  string $value
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function setHeader($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * @param  array $headers
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function setAllHeaders(array $headers)
    {
        $this->removeAllHeaders();

        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }

        return $this;
    }

    /**
     * @param  string $name
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function removeHeader($name)
    {
        if ($this->hasHeader($name)) {
            unset($this->headers[$name]);
        }

        return $this;
    }

    /**
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function removeAllHeaders()
    {
        foreach ($this->getAllHeaders() as $name => $value) {
            $this->removeHeader($name);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return boolean
     */
    public function hasBody()
    {
        return (null !== $this->getBody());
    }

    /**
     * @param  mixed $body
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function removeBody()
    {
        return $this->setBody(null);
    }

    /**
     * @return boolean
     */
    public function isError()
    {
        return ($this->getStatusCode() >= 400);
    }

}
