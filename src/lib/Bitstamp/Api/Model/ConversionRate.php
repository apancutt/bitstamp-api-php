<?php
namespace Bitstamp\Api\Model;

class ConversionRate extends \Bitstamp\Api\ModelAbstract
{

    private $buy;
    private $sell;

    /**
     * @return float
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * @param  float $buy
     * @return \Bitstamp\Api\Model\ConversionRate
     */
    public function setBuy($buy)
    {
        $this->buy = (float) $buy;

        return $this;
    }

    /**
     * @return float
     */
    public function getSell()
    {
        return $this->sell;
    }

    /**
     * @param  float $sell
     * @return \Bitstamp\Api\Model\ConversionRate
     */
    public function setSell($sell)
    {
        $this->sell = (float) $sell;

        return $this;
    }

}
