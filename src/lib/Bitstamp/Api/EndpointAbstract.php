<?php
namespace Bitstamp\Api;

abstract class EndpointAbstract
{

    private $client;

    // The URI must be configured by the endpoint
    const URI = null;

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
     * Shorthand method for executing a GET request on the client.
     *
     * @param  array $data
     * @param  array $headers
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function get(array $data = [], array $headers = [])
    {
        return $this->getClient()->get($this, $data, $headers);
    }

    /**
     * Shorthand method for executing a POST request on the client.
     *
     * @param  array $data
     * @param  array $headers
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function post(array $data = [], array $headers = [])
    {
        return $this->getClient()->post($this, $data, $headers);
    }

}
