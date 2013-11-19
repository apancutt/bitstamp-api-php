<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinDepositAddress extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/bitcoin_deposit_address/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
