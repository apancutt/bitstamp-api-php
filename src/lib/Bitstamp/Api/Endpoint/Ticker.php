<?php
namespace Bitstamp\Api\Endpoint;

class Ticker extends \Bitstamp\Api\GetEndpointAbstract
{

    const URI = "/ticker/";

    /**
     * @param  array $body
     * @return \Bitstamp\Api\Model\Ticker
     */
    protected function cast($body)
    {
        return (new \Bitstamp\Api\Model\Ticker($this->getClient()))
            ->setLast($body["last"])
            ->setHigh($body["high"])
            ->setLow($body["low"])
            ->setVolume($body["volume"])
            ->setBid($body["bid"])
            ->setAsk($body["ask"]);
    }

}
