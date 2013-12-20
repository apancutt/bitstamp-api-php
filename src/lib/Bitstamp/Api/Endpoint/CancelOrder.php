<?php
namespace Bitstamp\Api\Endpoint;

class CancelOrder extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/cancel_order/";

    /**
     * @param  integer $id
     * @return boolean
     */
    public function execute($id = null)
    {
        $data = [
	        "id" => $id
        ];

        return $this->cast($this->request($data)->getBody());
    }

}
