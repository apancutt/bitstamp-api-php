<?php
namespace Bitstamp\Api\Endpoint;

class BitcoinWithdrawal extends \Bitstamp\Api\PostEndpointAbstract
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

        return $this->request($data)->getBody();
    }

}
