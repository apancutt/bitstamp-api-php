<?php
namespace Bitstamp\Api;

abstract class EndpointAbstract
{

    private $client;

    const URI = null; // The URI must be configured by the endpoint

    /**
     * Creates and sends an HTTP request to the endpoint and returns the response object.
     *
     * @param  array $data
     * @return \Panadas\Module\HttpClient\Response
     */
    protected abstract function request(array $data = []);

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
     * Executes a request to the endpoint and returns a PHP type repesenting the response.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->cast($this->request()->getBody());
    }

    /**
     * Convert the raw body into a PHP type.
     *
     * @param  mixed $body
     * @return mixed
     */
    protected function cast($body)
    {
        return $body;
    }

}
