<?php
namespace Bitstamp\Api\Model;

class Balance extends \Bitstamp\Api\ModelAbstract
{

    private $usd_balance;
    private $btc_balance;
    private $usd_available;
    private $btc_available;
    private $usd_reserved;
    private $btc_reserved;
    private $fee;

    /**
     * @return float
     */
    public function getUsdBalance()
    {
        return $this->usd_balance;
    }

    /**
     * @param  float $usd_balance
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setUsdBalance($usd_balance)
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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setBtcBalance($btc_balance)
    {
        $this->btc_balance = (float) $btc_balance;

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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setUsdAvailable($usd_available)
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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setBtcAvailable($btc_available)
    {
        $this->btc_available = (float) $btc_available;

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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setUsdReserved($usd_reserved)
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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setBtcReserved($btc_reserved)
    {
        $this->btc_reserved = (float) $btc_reserved;

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
     * @return \Bitstamp\Api\Model\Balance
     */
    public function setFee($fee)
    {
        $this->fee = (float) $fee;

        return $this;
    }

}
