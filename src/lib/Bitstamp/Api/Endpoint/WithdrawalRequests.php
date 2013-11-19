<?php
namespace Bitstamp\Api\Endpoint;

class UserTransactions extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/withdrawal_requests/";

    public function execute()
    {
        $response = $this->post();

        print_r($response);
        exit;
    }

}
