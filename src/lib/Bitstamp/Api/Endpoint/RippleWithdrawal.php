<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/ripple_withdrawal/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($amount = null, $address = null, $currency = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address,
	        "currency" => $currency
        ];

        return $this->post($data)->getBody();
    }

}
