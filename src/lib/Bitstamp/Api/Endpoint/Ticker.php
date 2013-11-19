<?php
namespace Bitstamp\Api\Endpoint;

class Ticker extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ticker/";

    public function execute()
    {
        $response = $this->get();

        print_r($response);
        exit;
    }

}
