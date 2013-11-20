<?php
namespace Bitstamp\Api\Endpoint;

abstract class CodeAbstract extends \Bitstamp\Api\EndpointAbstract
{

    private $usd;
    private $btc;

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($code = null)
    {
        $data = [
            "code" => $code
        ];

        $body = $this->getClient()->post($this, $data)->getBody();

        return $this
            ->setUtc(static::getResponseParam($body, "utc"))
            ->setBtc(static::getResponseParam($body, "btc"));
    }

    /**
     * @return float
     */
    public function getUsd()
    {
        return $this->usd;
    }

    /**
     * @param  float $usd
     * @return \Bitstamp\Api\Endpoint\CodeAbstract
     */
    protected function setUsd($usd)
    {
        $this->usd = (float) $usd;

        return $this;
    }

    /**
     * @return float
     */
    public function getBtc()
    {
        return $this->btc;
    }

    /**
     * @param  float $btc
     * @return \Bitstamp\Api\Endpoint\CodeAbstract
     */
    protected function setBtc($btc)
    {
        $this->btc = (float) $btc;

        return $this;
    }

}
