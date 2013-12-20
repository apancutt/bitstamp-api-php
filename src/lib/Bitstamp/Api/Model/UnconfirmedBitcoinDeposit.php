<?php
namespace Bitstamp\Api\Model;

class UnconfirmedBitcoinDeposit extends \Bitstamp\Api\ModelAbstract
{

    private $address;
    private $amount;
    private $confirmations;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param  string $address
     * @return \Bitstamp\Api\Model\BitcoinDeposit
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param  float $amount
     * @return \Bitstamp\Api\Model\BitcoinDeposit
     */
    public function setAmount($amount)
    {
        $this->amount = (float) $amount;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConfirmations()
    {
        return $this->confirmations;
    }

    /**
     * @param  integer $confirmations
     * @return \Bitstamp\Api\Model\BitcoinDeposit
     */
    public function setConfirmations($confirmations)
    {
        $this->confirmations = (int) $confirmations;

        return $this;
    }

}
