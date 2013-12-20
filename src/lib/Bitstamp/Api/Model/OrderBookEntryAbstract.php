<?php
namespace Bitstamp\Api\Model;

abstract class OrderBookEntryAbstract extends \Bitstamp\Api\ModelAbstract
{

    private $order_book;
    private $price;
    private $amount;

    /**
     * @param \Bitstamp\Api\Model\OrderBook $order_book
     */
    public function __construct(\Bitstamp\Api\Model\OrderBook $order_book)
    {
        parent::__construct($order_book->getClient());

        $this->setOrderBook($order_book);
    }

    /**
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function getOrderBook()
    {
        return $this->order_book;
    }

    /**
     * @param  \Bitstamp\Api\Model\OrderBook $order_book
     * @return \Bitstamp\Api\Model\OrderBookEntryAbstract
     */
    public function setOrderBook(\Bitstamp\Api\Model\OrderBook $order_book)
    {
        $this->order_book = $order_book;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param  float $price
     * @return \Bitstamp\Api\Model\OrderBookEntryAbstract
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param  float $amount
     * @return \Bitstamp\Api\Model\OrderBookEntryAbstract
     */
    public function setAmount($amount)
    {
        $this->amount = (float) $amount;

        return $this;
    }

}
