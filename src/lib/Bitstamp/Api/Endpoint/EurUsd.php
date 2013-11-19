<?php
namespace Bitstamp\Api\Endpoint;

class EurUsd extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/eur_usd/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute()
    {
        return $this->get()->getBody();
    }

}
