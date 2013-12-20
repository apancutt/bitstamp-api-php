<?php
namespace Bitstamp\Api\Model\UserTransaction;

class MarketTrade extends \Bitstamp\Api\Model\UserTransactionAbstract
{

    private $order_id;

    /**
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param  integer $order_id
     * @return \Bitstamp\Api\Model\UserTransactionAbstract
     */
    public function setOrderId($order_id)
    {
        $this->order_id = (int) $order_id;

        return $this;
    }

}
