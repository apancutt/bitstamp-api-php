<?php
namespace Bitstamp\Api\Model;

abstract class UserTransactionAbstract extends \Bitstamp\Api\ModelAbstract
{

    private $id;
    private $datetime;
    private $usd;
    private $btc;
    private $fee;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  integer $id
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime($format = null)
    {
        if (null !== $format) {
            return $this->datetime->format($format);
        }

        return $this->datetime;
    }

    /**
     * @param  \DateTime $datetime
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setDateTime(\DateTime $datetime)
    {
        $this->datetime = $datetime;

        return $this;
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
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setUsd($usd)
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
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setBtc($btc)
    {
        $this->btc = (float) $btc;

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
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setFee($fee)
    {
        $this->fee = (float) $fee;

        return $this;
    }

}
