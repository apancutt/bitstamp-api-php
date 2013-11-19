<?php
namespace Bitstamp\Api\Endpoint;

class OpenOrders extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/open_orders/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->post()->getBody();
    }

}
