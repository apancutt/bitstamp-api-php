<?php
namespace Bitstamp\Api;

abstract class EndpointAbstract
{

    private $client;

    const URI = null; // The URI must be configured by the endpoint

    /**
     * Executes a request to the endpoint and returns the response.
     *
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
     * Default implementation for performing a request on the endpoint and returning the response body.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->request()->getBody();
    }

}
