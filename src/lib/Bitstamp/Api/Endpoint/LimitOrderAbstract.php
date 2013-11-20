<?php
namespace Bitstamp\Api\Endpoint;

abstract class LimitOrderAbstract extends \Bitstamp\Api\EndpointAbstract
{

    private $id;
    private $datetime;
    private $price;
    private $amount;

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($amount = null, $price = null)
    {
        $data = [
	        "amount" => $amount,
	        "price" => $price
        ];

        $body = $this->getClient()->post($this, $data)->getBody();

        return $this
            ->setId(static::getResponseParam($body, "id"))
            ->setDateTime(static::getResponseParam($body, "datetime")) // TODO: cast to DateTime
            ->setPrice(static::getResponseParam($body, "price"))
            ->setAmount(static::getResponseParam($body, "amount"));
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  integer $id
     * @return \Bitstamp\Api\Endpoint\LimitOrderAbstract
     */
    protected function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @param  string $format
     * @return mixed
     */
    public function getDateTime($format = null)
    {
        if (null === $this->datetime) {
            return null;
        }

        if (null !== $format) {
            return $this->datetime->format($format);
        }

        return $this->datetime;
    }

    /**
     * @param  \DateTime $datetime
     * @return \Bitstamp\Api\Endpoint\LimitOrderAbstract
     */
    protected function setDateTime(\DateTime $datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param  float $price
     * @return \Bitstamp\Api\Endpoint\LimitOrderAbstract
     */
    protected function setPrice($price)
    {
        $this->price = (float) $price;

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
     * @return \Bitstamp\Api\Endpoint\LimitOrderAbstract
     */
    protected function setAmount($amount)
    {
        $this->amount = (float) $amount;

        return $this;
    }

}
