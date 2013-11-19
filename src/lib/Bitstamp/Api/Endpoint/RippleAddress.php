<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinAddress extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ripple_address/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->post()->getBody();
    }

}
