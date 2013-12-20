<?php
namespace Bitstamp\Api\Model;

class Ticker extends \Bitstamp\Api\ModelAbstract
{

    private $last;
    private $high;
    private $low;
    private $volume;
    private $bid;
    private $ask;

    /**
     * @return float
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @param  float $last
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setLast($last)
    {
        $this->last = (float) $last;

        return $this;
    }

    /**
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param  float $high
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setHigh($high)
    {
        $this->high = (float) $high;

        return $this;
    }

    /**
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * @param  float $low
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setLow($low)
    {
        $this->low = (float) $low;

        return $this;
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param  float $volume
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setVolume($volume)
    {
        $this->volume = (float) $volume;

        return $this;
    }

    /**
     * @return float
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param  float $bid
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setBid($bid)
    {
        $this->bid = (float) $bid;

        return $this;
    }

    /**
     * @return float
     */
    public function getAsk()
    {
        return $this->ask;
    }

    /**
     * @param  float $ask
     * @return \Bitstamp\Api\Model\Ticker
     */
    public function setAsk($ask)
    {
        $this->ask = (float) $ask;

        return $this;
    }

}
