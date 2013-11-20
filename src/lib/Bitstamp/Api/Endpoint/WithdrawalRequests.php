<?php
namespace Bitstamp\Api\Endpoint;

class UserTransactions extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/withdrawal_requests/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        // TODO: create property for list of requests [id, datetime, type, amount, status, data]
        return $this->getClient()->post($this)->getBody();
    }

}
