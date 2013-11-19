<?php
namespace Bitstamp\Api\Endpoint;

abstract class LimitOrderAbstract extends \Bitstamp\Api\EndpointAbstract
{

    public function execute($amount = null, $price = null)
    {
        $data = [
	        "amount" => $amount,
	        "price" => $price
        ];

        $response = $this->post($data);

        print_r($response);
        exit;
    }

}
