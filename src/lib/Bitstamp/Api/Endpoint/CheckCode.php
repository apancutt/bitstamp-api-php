<?php
namespace Bitstamp\Api\Endpoint;

class CheckCode extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/check_code/";

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
