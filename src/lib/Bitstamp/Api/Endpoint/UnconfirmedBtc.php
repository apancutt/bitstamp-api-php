<?php
namespace Bitstamp\Api\Endpoint;

class UnconfirmedBtc extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/unconfirmed_btc/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->post()->getBody();
    }

}
