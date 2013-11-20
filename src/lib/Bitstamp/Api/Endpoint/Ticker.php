<?php
namespace Bitstamp\Api\Endpoint;

class Ticker extends \Bitstamp\Api\EndpointAbstract
{

    private $timestamp;
    private $high;
    private $low;
    private $last;
    private $bid;
    private $ask;
    private $volume;

    const URI = "/ticker/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        $body = $this->getClient()->get($this)->getBody();

        return $this
            ->setTimestamp(static::getResponseParam($body, "timestamp"))
            ->setHigh(static::getResponseParam($body, "high"))
            ->setLow(static::getResponseParam($body, "low"))
            ->setLast(static::getResponseParam($body, "last"))
            ->setBid(static::getResponseParam($body, "bid"))
            ->setAsk(static::getResponseParam($body, "ask"))
            ->setVolume(static::getResponseParam($body, "volume"));
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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setTimestamp($timestamp)
    {
        $this->timestamp = (int) $timestamp;

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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setHigh($high)
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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setLow($low)
    {
        $this->low = (float) $low;

        return $this;
    }

    /**
     * @return float
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @param  float $last
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setLast($last)
    {
        $this->last = (float) $last;

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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setBid($bid)
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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setAsk($ask)
    {
        $this->ask = (float) $ask;

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
     * @return \Bitstamp\Api\Endpoint\Ticker
     */
    protected function setVolume($volume)
    {
        $this->volume = (float) $volume;

        return $this;
    }

}
