<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ripple_withdrawal/";

    public function execute($amount = null, $address = null, $currency = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address,
	        "currency" => $currency
        ];

        $response = $this->post($data);

        print_r($response);
        exit;
    }

}
