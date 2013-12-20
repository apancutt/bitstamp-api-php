<?php
namespace Bitstamp\Api\Endpoint;

class OrderBook extends \Bitstamp\Api\GetEndpointAbstract
{

    const URI = "/order_book/";

    /**
     * @param  boolean $group
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function execute($group = true)
    {
        $data = [
	        "group" => ($group ? 1 : 0)
        ];

        return $this->cast($this->request($data)->getBody());
    }

    /**
     * @param  array $body
     * @return \Bitstamp\Api\Model\OrderBook
     */
    protected function cast($body)
    {
        $order_book = (new \Bitstamp\Api\Model\OrderBook($this->getClient()));

        foreach ($body["bids"] as $bid) {
            $order_book->addBid(
                (new \Bitstamp\Api\Model\OrderBookEntry\Bid($order_book))
                    ->setPrice($bid[0])
                    ->setAmount($bid[1])
            );
        }

        foreach ($body["asks"] as $ask) {
            $order_book->addAsk(
                (new \Bitstamp\Api\Model\OrderBookEntry\Ask($order_book))
                    ->setPrice($bid[0])
                    ->setAmount($bid[1])
            );
        }

        return $order_book;
    }

}
