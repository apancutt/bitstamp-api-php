<?php
namespace Bitstamp\Api\Endpoint;

class CancelOrder extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/cancel_order/";

    public function execute($id = null)
    {
        $data = [
	        "id" => $id
        ];

        $response = $this->post($data);

        print_r($response);
        exit;
    }

}
