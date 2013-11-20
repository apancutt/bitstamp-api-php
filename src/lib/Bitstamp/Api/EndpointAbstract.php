<?php
namespace Bitstamp\Api;

abstract class EndpointAbstract
{

    private $client;

    const URI = null; // The URI must be configured by the endpoint

    /**
     * Execute the endpoint and handles the response. The returned value depends on the implementation of the endpoint.
     *
     * @return mixed
     */
    public abstract function execute();

    /**
     * @param \Bitstamp\Api\Client $client
     */
    public function __construct(\Bitstamp\Api\Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @return \Bitstamp\Api\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param  \Bitstamp\Api\Client $client
     * @return \Bitstamp\Api\EndpointAbstract
     */
    protected function setClient(\Bitstamp\Api\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Shorthand method for retrieving a parameter from the response body.
     *
     * @param  array $body
     * @param  string $name
     * @throws \RuntimeException
     * @return mixed
     */
    protected static function getResponseParam(array $body, $name)
    {
        if ( ! array_key_exists($name, $body)) {
            throw new \RuntimeException("Missing required response param: {$name}");
        }

        return $body[$name];
    }

}
