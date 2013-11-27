<?php
namespace Bitstamp\Api;

abstract class GetEndpointAbstract extends \Bitstamp\Api\EndpointAbstract
{

    /**
     * @see \Bitstamp\Api\EndpointAbstract::request()
     */
    protected function request(array $data = [])
    {
        return $this->getClient()->get($this, $data);
    }

}
