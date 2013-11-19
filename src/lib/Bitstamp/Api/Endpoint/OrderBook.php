<?php
namespace Bitstamp\Api\Endpoint;

class OrderBook extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/order_book/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($group = true)
    {
        $data = [
	        "group" => ($group ? 1 : 0)
        ];

        return $this->get($data)->getBody();
    }

}
