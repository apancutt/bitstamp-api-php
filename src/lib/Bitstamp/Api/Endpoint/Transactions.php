<?php
namespace Bitstamp\Api\Endpoint;

class Transactions extends \Bitstamp\Api\GetEndpointAbstract
{

    const URI = "/transactions/";

    const TIME_HOUR = "hour";
    const TIME_MINUTE = "minute";
    const TIME_DEFAULT = self::TIME_HOUR;

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($time = self::TIME_DEFAULT)
    {
        $data = [
	        "time" => $time
        ];

        return $this->request($data)->getBody();
    }

}
