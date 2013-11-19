<?php
namespace Bitstamp\Api\Endpoint;

class UserTransactions extends \Bitstamp\Api\EndpointAbstract
{

    const URI = "/user_transactions/";

    const SORT_ASCENDING = "asc";
    const SORT_DESCENDING = "desc";
    const SORT_DEFAULT = self::SORT_DESCENDING;

    /**
     * @see \Bitstamp\Api\EndpointAbstract::execute()
     */
    public function execute($offset = 0, $limit = 100, $sort = self::SORT_DEFAULT)
    {
        $data = [
	        "offset" => $offset,
	        "limit" => $limit,
	        "sort" => $sort
        ];

        return $this->post($data)->getBody();
    }

}
