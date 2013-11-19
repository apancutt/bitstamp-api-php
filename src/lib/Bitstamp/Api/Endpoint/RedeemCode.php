<?php
namespace Bitstamp\Api\Endpoint;

class RedeemCode extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/redeem_code/";

    public function execute($code = null)
    {
        $data = [
	        "code" => $code
        ];

        $response = $this->post($data);

        print_r($response);
        exit;
    }

}
