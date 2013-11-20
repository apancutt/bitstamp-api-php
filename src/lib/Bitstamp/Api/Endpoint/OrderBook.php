<?php
namespace Bitstamp\Api\Endpoint;

class OrderBook extends \Bitstamp\Api\EndpointAbstract
{

    private $timestamp;
    private $bids = [];

    const URI = "/order_book/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($group = true)
    {
        $data = [
	        "group" => ($group ? 1 : 0)
        ];

        $body = $this->getClient()->get($this, $data)->getBody();

        // TODO: create property for "bids" => [price, amount], "asks" => [price, amount]
        return $this->setTimestamp(static::getResponseParam($body, "timestamp"));
    }

    /**
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param  integer $timestamp
     * @return \Bitstamp\Api\Endpoint\OrderBook
     */
    protected function setTimestamp($timestamp)
    {
        $this->timestamp = (int) $timestamp;

        return $this;
    }

}
