<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/bitcoin_withdrawal/";

    public function execute($amount = null, $address = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address
        ];

        $response = $this->post($data);

        print_r($response);
        exit;
    }

}
