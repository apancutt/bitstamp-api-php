<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/bitcoin_withdrawal/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($amount = null, $address = null)
    {
        $data = [
	        "amount" => $amount,
	        "address" => $address
        ];

        return $this->post($data)->getBody();
    }

}
