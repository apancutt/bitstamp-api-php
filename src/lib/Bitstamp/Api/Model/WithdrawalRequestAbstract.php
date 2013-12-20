<?php
namespace Bitstamp\Api\Model;

abstract class WithdrawalRequestAbstract extends \Bitstamp\Api\ModelAbstract
{

    private $id;
    private $datetime;
    private $amount;
    private $status;
    private $data;

    const STATUS_OPEN = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_FINISHED = 2;
    const STATUS_CANCELED = 3;
    const STATUS_FAILED = 4;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  integer $id
     * @return \Bitstamp\Api\Model\WithdrawalRequestAbstract
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
     * @return \Bitstamp\Api\Model\WithdrawalRequestAbstract
     */
    public function setDateTime(\DateTime $datetime)
    {
        $this->datetime = $datetime;

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
     * @return \Bitstamp\Api\Model\WithdrawalRequestAbstract
     */
    public function setAmount($amount)
    {
        $this->amount = (float) $amount;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  integer $status
     * @return \Bitstamp\Api\Model\WithdrawalRequestAbstract
     */
    public function setStatus($status)
    {
        $this->status = (int) $status;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOpen()
    {
        return ($this->getStatus() === static::STATUS_OPEN);
    }

    /**
     * @return boolean
     */
    public function isInProgress()
    {
        return ($this->getStatus() === static::STATUS_IN_PROGRESS);
    }

    /**
     * @return boolean
     */
    public function isFinished()
    {
        return ($this->getStatus() === static::STATUS_FINISHED);
    }

    /**
     * @return boolean
     */
    public function isCanceled()
    {
        return ($this->getStatus() === static::STATUS_CANCELED);
    }

    /**
     * @return boolean
     */
    public function isFailed()
    {
        return ($this->getStatus() === static::STATUS_FAILED);
    }

    /**
     * @return float
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param  float $data
     * @return \Bitstamp\Api\Model\WithdrawalRequestAbstract
     */
    public function setData($data)
    {
        $this->data = (float) $data;

        return $this;
    }

}
