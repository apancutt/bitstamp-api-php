<?php
namespace Bitstamp\Api\Endpoint;

class RippleWithdrawal extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/ripple_withdrawal/";

    /**
     * @param  float  $amount
     * @param  string $address
     * @param  string $currency
     * @return boolean
     */
    public function execute($amount = null, $address = null, $currency = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address,
	        "currency" => $currency
        ];

        return $this->cast($this->request($data)->getBody());
    }

}
