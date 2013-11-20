<?php
namespace Bitstamp\Api\Endpoint;

class EurUsd extends \Bitstamp\Api\EndpointAbstract
{

    private $buy;
    private $sell;

    const URI = "/eur_usd/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        $body = $this->getClient()->get($this)->getBody();

        return $this
            ->setBuy(static::getResponseParam($body, "buy"))
            ->setSell(static::getResponseParam($body, "sell"));
    }

    /**
     * @return float
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * @param  float $buy
     * @return \Bitstamp\Api\Endpoint\EurUsd
     */
    protected function setBuy($buy)
    {
        $this->buy = (float) $buy;

        return $this;
    }

    /**
     * @return float
     */
    public function getSell()
    {
        return $this->sell;
    }

    /**
     * @param  float $sell
     * @return \Bitstamp\Api\Endpoint\EurUsd
     */
    protected function setSell($sell)
    {
        $this->sell = (float) $sell;

        return $this;
    }

}
