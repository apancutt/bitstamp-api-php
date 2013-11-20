<?php
namespace Bitstamp\Api\Endpoint;

class Balance extends \Bitstamp\Api\EndpointAbstract
{

    private $usd_balance;
    private $btc_balance;
    private $usd_reserved;
    private $btc_reserved;
    private $usd_available;
    private $btc_available;
    private $fee;

    const URI = "/balance/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        $body = $this->getClient()->post($this)->getBody();

        return $this
            ->setUsdBalance(static::getResponseParam($body, "usd_balance"))
            ->setBtcBalance(static::getResponseParam($body, "btc_balance"))
            ->setUsdReserved(static::getResponseParam($body, "usd_reserved"))
            ->setBtcReserved(static::getResponseParam($body, "btc_reserved"))
            ->setUsdAvailable(static::getResponseParam($body, "usd_available"))
            ->setBtcAvailable(static::getResponseParam($body, "btc_available"))
            ->setFee(static::getResponseParam($body, "fee"));
    }

    /**
     * @return float
     */
    public function getUsdBalance()
    {
        return $this->usd_balance;
    }

    /**
     * @param  float $usd_balance
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setUsdBalance($usd_balance)
    {
        $this->usd_balance = (float) $usd_balance;

        return $this;
    }

    /**
     * @return float
     */
    public function getBtcBalance()
    {
        return $this->btc_balance;
    }

    /**
     * @param  float $btc_balance
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setBtcBalance($btc_balance)
    {
        $this->btc_balance = (float) $btc_balance;

        return $this;
    }

    /**
     * @return float
     */
    public function getUsdReserved()
    {
        return $this->usd_reserved;
    }

    /**
     * @param  float $usd_reserved
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setUsdReserved($usd_reserved)
    {
        $this->usd_reserved = (float) $usd_reserved;

        return $this;
    }

    /**
     * @return float
     */
    public function getBtcReserved()
    {
        return $this->btc_reserved;
    }

    /**
     * @param  float $btc_reserved
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setBtcReserved($btc_reserved)
    {
        $this->btc_reserved = (float) $btc_reserved;

        return $this;
    }

    /**
     * @return float
     */
    public function getUsdAvailable()
    {
        return $this->usd_available;
    }

    /**
     * @param  float $usd_available
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setUsdAvailable($usd_available)
    {
        $this->usd_available = (float) $usd_available;

        return $this;
    }

    /**
     * @return float
     */
    public function getBtcAvailable()
    {
        return $this->btc_available;
    }

    /**
     * @param  float $btc_available
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setBtcAvailable($btc_available)
    {
        $this->btc_available = (float) $btc_available;

        return $this;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param  float $fee
     * @return \Bitstamp\Api\Endpoint\Balance
     */
    protected function setFee($fee)
    {
        $this->fee = (float) $fee;

        return $this;
    }

}
