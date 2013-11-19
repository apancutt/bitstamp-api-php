<?php
namespace Bitstamp\Api\Endpoint;

class Balance extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/balance/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
