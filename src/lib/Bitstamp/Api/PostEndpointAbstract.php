<?php
namespace Bitstamp\Api;

abstract class PostEndpointAbstract extends \Bitstamp\Api\EndpointAbstract
{

    /**
     * @see \Bitstamp\Api\EndpointAbstract::request()
     */
    protected function request(array $data = [])
    {
        return $this->getClient()->post($this, $data);
    }

}
