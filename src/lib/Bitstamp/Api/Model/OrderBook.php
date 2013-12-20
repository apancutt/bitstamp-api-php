<?php
namespace Bitstamp\Api\Model;

class OrderBook extends \Bitstamp\Api\ModelAbstract
{

    private $bids;
    private $asks;

    /**
     * @param  \Bitstamp\Api\Model\OrderBookEntry\Bid $bid
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function addBid(\Bitstamp\Api\Model\OrderBookEntry\Bid $bid)
    {
        $this->bids[] = $bid;

        return $this;
    }

    /**
     * @param  array $bids
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function addManyBids(array $bids)
    {
        foreach ($bids as $bid) {
            $this->addBid($bid);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAllBids()
    {
        return $this->bids;
    }

    /**
     * @return boolean
     */
    public function hasAnyBids()
    {
        return (count($this->getAllBids()) > 0);
    }

    /**
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function removeAllBids()
    {
        $this->bids = [];

        return $this;
    }

    /**
     * @param  array $asks
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function replaceBids(array $bids)
    {
        return $this
            ->removeAllBids()
            ->addManyBids($bids);
    }

    /**
     * @param  \Bitstamp\Api\Model\OrderBookEntry\Ask $ask
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function addAsk(\Bitstamp\Api\Model\OrderBookEntry\Ask $ask)
    {
        $this->asks[] = $ask;

        return $this;
    }

    /**
     * @param  array $asks
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function addManyAsks(array $asks)
    {
        foreach ($asks as $ask) {
            $this->addAsk($ask);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAllAsks()
    {
        return $this->asks;
    }

    /**
     * @return boolean
     */
    public function hasAnyAsks()
    {
        return (count($this->getAllAsks()) > 0);
    }

    /**
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function removeAllAsks()
    {
        $this->asks = [];

        return $this;
    }

    /**
     * @param  array $asks
     * @return \Bitstamp\Api\Model\OrderBook
     */
    public function replaceAsks(array $asks)
    {
        return $this
            ->removeAllAsks()
            ->addManyAsks($asks);
    }

}
