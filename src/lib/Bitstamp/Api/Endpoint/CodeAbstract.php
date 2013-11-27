<?php
namespace Bitstamp\Api\Endpoint;

abstract class CodeAbstract extends \Bitstamp\Api\PostEndpointAbstract
{

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($code = null)
    {
        $data = [
            "code" => $code
        ];

        return $this->request($data)->getBody();
    }

}
