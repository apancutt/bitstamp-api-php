<?php
namespace Bitstamp\Api\Endpoint;

class RedeemCode extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/redeem_code/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($code = null)
    {
        $data = [
	        "code" => $code
        ];

        return $this->post($data)->getBody();
    }

}
