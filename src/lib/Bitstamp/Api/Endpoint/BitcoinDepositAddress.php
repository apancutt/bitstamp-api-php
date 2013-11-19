<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinDepositAddress extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/bitcoin_deposit_address/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->post()->getBody();
    }

}
