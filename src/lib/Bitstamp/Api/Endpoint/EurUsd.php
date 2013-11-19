<?php
namespace Bitstamp\Api\Endpoint;

class EurUsd extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/eur_usd/";

    public function execute()
    {
        $response = $this->get();

        print_r($response);
        exit;
    }

}
