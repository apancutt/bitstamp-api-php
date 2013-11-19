<?php
namespace Bitstamp\Api\Endpoint;

abstract class LimitOrderAbstract extends \Bitstamp\Api\EndpointAbstract
{

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($amount = null, $price = null)
    {
        $data = [
	        "amount" => $amount,
	        "price" => $price
        ];

        return $this->post($data)->getBody();
    }

}
