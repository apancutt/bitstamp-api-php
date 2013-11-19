<?php
namespace Bitstamp\Api\Endpoint;

class OrderBook extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/order_book/";

    public function execute($group = true)
    {
        $data = [
	        "group" => ($group ? 1 : 0)
        ];

        $response = $this->get($data);

        print_r($response);
        exit;
    }

}
