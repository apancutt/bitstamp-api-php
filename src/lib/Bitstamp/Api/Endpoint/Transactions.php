<?php
namespace Bitstamp\Api\Endpoint;

class Transactions extends \Bitstamp\Api\GetEndpointAbstract
{

    const URI = "/transactions/";

    const TIME_HOUR = "hour";
    const TIME_MINUTE = "minute";
    const TIME_DEFAULT = self::TIME_HOUR;

    /**
     * @param  string $time
     * @return array
     */
    public function execute($time = self::TIME_DEFAULT)
    {
        $data = [
	        "time" => $time
        ];

        return $this->cast($this->request($data)->getBody());
    }

    /**
     * @param  array $body
     * @return array
     */
    protected function cast($body)
    {
        $transactions = [];

        foreach ($body as $transaction) {
            $transactions[] = (new \Bitstamp\Api\Model\Transaction($this->getClient()))
                ->setId($transaction["tid"])
                ->setDateTime(\DateTime::createFromFormat("U", $transaction["date"], new \DateTimeZone("UTC")))
                ->setPrice($transaction["price"])
                ->setAmount($transaction["amount"]);
        }

        return $transactions;
    }

}
