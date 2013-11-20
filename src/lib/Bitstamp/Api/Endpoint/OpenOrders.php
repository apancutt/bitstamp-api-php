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
        // TODO: create property for orders
        return $this->getClient()->post($this)->getBody();
    }

}
