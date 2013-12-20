<?php
namespace Bitstamp\Api\Endpoint;

class EurUsd extends \Bitstamp\Api\GetEndpointAbstract
{

    const URI = "/eur_usd/";

    /**
     * @param  array $body
     * @return \Bitstamp\Api\Model\ConversionRate
     */
    protected function cast($body)
    {
        return (new \Bitstamp\Api\Model\ConversionRate($this->getClient()))
            ->setBuy($body["buy"])
            ->setSell($body["sell"]);
    }

}
