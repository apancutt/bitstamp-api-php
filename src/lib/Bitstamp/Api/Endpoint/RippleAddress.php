<?php
namespace Bitstamp\Api\Endpoint;

class RippleAddress extends \Bitstamp\Api\PostEndpointAbstract
{

    const URI = "/ripple_address/";

    /**
     * @param  array $body
     * @return string
     */
    protected function cast($body)
    {
        return $body["address"];
    }

}
