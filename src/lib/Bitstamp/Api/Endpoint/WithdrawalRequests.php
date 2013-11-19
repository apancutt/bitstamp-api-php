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
        return $this->post()->getBody();
    }

}
