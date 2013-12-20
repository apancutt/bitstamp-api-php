<?php
namespace Bitstamp\Api\Endpoint;

class OpenOrders extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/open_orders/";

    /**
     * @param  array $body
     * @return array
     */
    protected function cast($body)
    {
        $client = $this->getClient();

        $open_orders = [];

        foreach ($body as $open_order) {
            $open_orders[] = \Bitstamp\Api\Endpoint\LimitOrderAbstract::castToLimitOrder($client, $open_order);
        }

        return $open_orders;
    }

}
