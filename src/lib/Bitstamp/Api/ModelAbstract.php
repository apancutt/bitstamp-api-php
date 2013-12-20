<?php
namespace Bitstamp\Api;

abstract class ModelAbstract
{

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
     * @return \Bitstamp\Api\ModelAbstract
     */
    protected function setClient(\Bitstamp\Api\Client $client)
    {
        $this->client = $client;

        return $this;
    }

}
