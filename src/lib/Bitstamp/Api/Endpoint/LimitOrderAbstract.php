<?php
namespace Bitstamp\Api\Endpoint;

abstract class LimitOrderAbstract extends \Bitstamp\Api\PostEndpointAbstract
{

    const TYPE_BUY = 0;
    const TYPE_SELL = 1;

    /**
     * @param  float $amount
     * @param  float $price
     * @return \Bitstamp\Api\Model\LimitOrderAbstract
     */
    public function execute($amount = null, $price = null)
    {
        $data = [
	        "amount" => $amount,
	        "price" => $price
        ];

        return $this->cast($this->request($data)->getBody());
    }

    /**
     * @param  array $body
     * @return \Bitstamp\Api\Model\LimitOrderAbstract
     */
    protected function cast($body)
    {
        return static::castToLimitOrder($this->getClient(), $body);
    }

    /**
     * @param  \Bitstamp\Api\Client $client
     * @param  array                $body
     * @return \Bitstamp\Api\Model\LimitOrderAbstract
     */
    public static function castToLimitOrder(\Bitstamp\Api\Client $client, $body)
    {
        switch ($body["type"]) {

        	case static::TYPE_BUY:
        	    $instance = new \Bitstamp\Api\Model\LimitOrder\Buy($client);
        	    break;

        	case static::TYPE_SELL:
        	    $instance = new \Bitstamp\Api\Model\LimitOrder\Sell($client);
        	    break;

        	default:
        	    throw new \UnexpectedValueException("Unsupported order type: {$body["type"]}");

        }

        if (false !== mb_strpos($body["datetime"], ".")) {
            $datetime_format = "Y-m-d H:i:s.u";
        } else {
            $datetime_format = "Y-m-d H:i:s";
        }

        return $instance
            ->setId($body["id"])
            ->setDateTime(\DateTime::createFromFormat($datetime_format, $body["datetime"], new \DateTimeZone("UTC")))
            ->setPrice($body["price"])
            ->setAmount($body["amount"]);
    }

}
