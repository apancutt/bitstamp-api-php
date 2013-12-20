<?php
namespace Bitstamp\Api\Endpoint;

class UserTransactions extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/user_transactions/";

    const SORT_ASCENDING = "asc";
    const SORT_DESCENDING = "desc";
    const SORT_DEFAULT = self::SORT_DESCENDING;

    const TYPE_DEPOSIT = 0;
    const TYPE_WITHDRAWAL = 1;
    const TYPE_MARKET_TRADE = 2;

    /**
     * @param  integer $offset
     * @param  integer $limit
     * @param  integer $sort
     * @return array
     */
    public function execute($offset = 0, $limit = 100, $sort = self::SORT_DEFAULT)
    {
        $data = [
	        "offset" => $offset,
	        "limit" => $limit,
	        "sort" => $sort
        ];

        return $this->cast($this->request($data)->getBody());
    }

    /**
     * @param  array $body
     * @return array
     */
    protected function cast($body)
    {
        $client = $this->getClient();

        $user_transactions = [];

        foreach ($body as $user_transaction) {

            switch ($user_transaction["type"]) {

            	case static::TYPE_DEPOSIT:
            	    $instance = new \Bitstamp\Api\Model\UserTransaction\Deposit($client);
            	    break;

            	case static::TYPE_WITHDRAWAL:
            	    $instance = new \Bitstamp\Api\Model\UserTransaction\Withdrawal($client);
            	    break;

            	case static::TYPE_MARKET_TRADE:
            	    $instance = (new \Bitstamp\Api\Model\UserTransaction\MarketTrade($client))
                        ->setOrderId($user_transaction["order_id"]);
            	    break;

            	default:
            	    throw new \UnexpectedValueException("Unsupported transaction type: {$user_transaction["type"]}");
            }

            $user_transactions[] = $instance
                ->setId($user_transaction["id"])
                ->setDateTime(
                    \DateTime::createFromFormat("Y-m-d H:i:s", $user_transaction["datetime"], new \DateTimeZone("UTC"))
                )
                ->setUsd($user_transaction["usd"])
                ->setBtc($user_transaction["btc"])
                ->setFee($user_transaction["fee"]);
        }

        return $user_transactions;
    }

}
