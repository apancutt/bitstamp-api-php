<?php
namespace Bitstamp\Api\Endpoint;

class UnconfirmedBitcoinDeposits extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/unconfirmed_btc/";

    /**
     * @param  array $body
     * @return array
     */
    protected function cast($body)
    {
        $client = $this->getClient();

        $unconfirmed_bitcoin_deposits = [];

        foreach ($body as $unconfirmed_bitcoin_deposit) {
            $unconfirmed_bitcoin_deposits[] = (new \Bitstamp\Api\Model\UnconfirmedBitcoinDeposit($client))
                ->setAddress($unconfirmed_bitcoin_deposit["address"])
                ->setAmount($unconfirmed_bitcoin_deposit["amount"])
                ->setConfirmations($unconfirmed_bitcoin_deposit["confirmations"]);
        }

        return $unconfirmed_bitcoin_deposits;
    }

}
