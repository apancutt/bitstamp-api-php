<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/bitcoin_withdrawal/";

    /**
     * @param  float  $amount
     * @param  string $address
     * @return boolean
     */
    public function execute($amount = null, $address = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address
        ];

        return $this->cast($this->request($data)->getBody());
    }

}
