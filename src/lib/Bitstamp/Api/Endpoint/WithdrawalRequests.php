<?php
namespace Bitstamp\Api\Endpoint;

class WithdrawalRequests extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/withdrawal_requests/";

    const TYPE_SEPA = 0;
    const TYPE_BITCOIN = 1;
    const TYPE_WIRE = 2;
    const TYPE_BITSTAMP = 3;
    const TYPE_BITSTAMP2 = 4;
    const TYPE_MTGOX = 5;

    /**
     * @param  array $body
     * @return array
     */
    protected function cast($body)
    {
        $client = $this->getClient();

        $withdrawal_requests = [];

        foreach ($body as $withdrawal_request) {

            switch ($withdrawal_request["type"]) {

            	case static::TYPE_SEPA:
            	    $instance = new \Bitstamp\Api\Model\WithdrawalRequest\Sepa($client);
            	    break;

            	case static::TYPE_BITCOIN:
            	    $instance = new \Bitstamp\Api\Model\WithdrawalRequest\Bitcoin($client);
            	    break;

            	case static::TYPE_WIRE:
            	    $instance = new \Bitstamp\Api\Model\WithdrawalRequest\Wire($client);
            	    break;

            	case static::TYPE_BITSTAMP:
            	case static::TYPE_BITSTAMP2:
            	    $instance = new \Bitstamp\Api\Model\WithdrawalRequest\Bitstamp($client);
            	    break;

            	case static::TYPE_MTGOX:
            	    $instance = new \Bitstamp\Api\Model\WithdrawalRequest\MtGox($client);
            	    break;

            	default:
            	    throw new \UnexpectedValueException("Unsupported withdrawal type: {$withdrawal_request["type"]}");
            }

            $withdrawal_requests[] = $instance
                ->setId($withdrawal_request["id"])
                ->setDateTime(
                    \DateTime::createFromFormat("Y-m-d H:i:s", $withdrawal_request["datetime"], new \DateTimeZone("UTC"))
                )
                ->setAmount($withdrawal_request["amount"])
                ->setStatus($withdrawal_request["status"])
                ->setData($withdrawal_request["data"]);
        }

        return $withdrawal_requests;
    }

}
