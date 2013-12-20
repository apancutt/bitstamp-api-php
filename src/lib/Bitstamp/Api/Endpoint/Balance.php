<?php
namespace Bitstamp\Api\Endpoint;

class Balance extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/balance/";

    /**
     * @param  array $body
     * @return \Bitstamp\Api\Model\Balance
     */
    protected function cast($body)
    {
        return (new \Bitstamp\Api\Model\Balance($this->getClient()))
            ->setUsdBalance($body["usd_balance"])
            ->setBtcBalance($body["btc_balance"])
            ->setUsdAvailable($body["usd_available"])
            ->setBtcAvailable($body["btc_available"])
            ->setUsdReserved($body["usd_reserved"])
            ->setBtcReserved($body["btc_reserved"])
            ->setFee($body["fee"]);
    }

}
