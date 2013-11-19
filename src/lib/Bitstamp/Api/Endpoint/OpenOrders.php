<?php
namespace Bitstamp\Api\Endpoint;

class OpenOrders extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/open_orders/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
