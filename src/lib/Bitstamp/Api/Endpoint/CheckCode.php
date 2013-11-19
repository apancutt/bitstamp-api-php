<?php
namespace Bitstamp\Api\Endpoint;

class CheckCode extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/check_code/";

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($code = null)
    {
        $data = [
	        "code" => $code
        ];

        return $this->post($data)->getBody();
    }

}
