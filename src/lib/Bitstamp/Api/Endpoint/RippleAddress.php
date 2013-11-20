<?php
namespace Bitstamp\Api\Endpoint;

class RippleAddress extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ripple_address/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->getClient()->post($this)->getBody();
    }

}
