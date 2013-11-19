<?php
namespace Bitstamp\Api\Endpoint;

class CancelOrder extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/cancel_order/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($id = null)
    {
        $data = [
	        "id" => $id
        ];

        return $this->post($data)->getBody();
    }

}
