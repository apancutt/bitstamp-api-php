<?php
namespace Bitstamp\Api\Endpoint;

class Ticker extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ticker/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->get()->getBody();
    }

}
