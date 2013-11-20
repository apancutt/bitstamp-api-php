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
        // TODO: create property for list of deposits [amount, address, confirmations]
        return $this->getClient()->post($this)->getBody();
    }

}
