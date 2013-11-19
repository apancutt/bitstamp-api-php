<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinAddress extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ripple_address/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
