<?php
namespace Bitstamp\Api\Endpoint;

class Balance extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/balance/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->post()->getBody();
    }

}
