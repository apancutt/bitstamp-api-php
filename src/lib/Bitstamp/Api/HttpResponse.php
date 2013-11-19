<?php
namespace Bitstamp\Api;

class HttpResponse
{

    private $status_code;
    private $headers = [];
    private $body;

    /**
     * @param integer $status_code
     * @param array   $headers
     * @param string  $body
     */
    public function __construct($status_code = 200, array $headers = [], $body = null)
    {
        $this
            ->setStatusCode($status_code)
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
