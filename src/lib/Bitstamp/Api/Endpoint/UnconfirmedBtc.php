<?php
namespace Bitstamp\Api\Endpoint;

class UnconfirmedBtc extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/unconfirmed_btc/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
