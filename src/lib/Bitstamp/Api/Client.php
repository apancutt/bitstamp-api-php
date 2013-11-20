<?php
namespace Bitstamp\Api;

class Client
{

    private $request;
    private $client_id;
    private $api_secret;
    private $api_key;

    const VERSION = "0.0.1";
    const ENDPOINT_BASE_URI = "https://www.bitstamp.net/api";

    /**
     * @param \Panadas\Module\HttpClient\Request $request
     * @param string                             $client_id
     * @param string                             $api_secret
     * @param string                             $api_key
     */
    public function __construct(
        \Panadas\Module\HttpClient\Request $request,
        $client_id,
        $api_secret,
        $api_key
    )
    {
        $this
            ->setRequest($request)
            ->setClientId($client_id)
            ->setApiSecret($api_secret)
            ->setApiKey($api_key);

        $logger = $request->getLogger();

        if (null !== $logger) {
            $logger
                ->debug("Bitstamp client has been configured:")
                ->debug("     Client ID: {$this->getClientId()}")
                ->debug("     API Secret: " . \Panadas\Util\String::mask($this->getApiSecret(), true))
                ->debug("     API Key: {$this->getApiKey()}");
        }
    }

    /**
     * @return \Panadas\Module\HttpClient\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param  \Panadas\Module\HttpClient\Request $request
     * @return \Bitstamp\Api\Client
     */
    protected function setRequest(\Panadas\Module\HttpClient\Request $request)
    {
        $request->setOption(
            CURLOPT_USERAGENT,
            sprintf(
                "Mozilla/4.0 (compatible; BtcTrader/%s; %s; PHP/%s)", static::VERSION, php_uname("s"), phpversion()
            )
        );

        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param  string $client_id
     * @return \Bitstamp\Api\Client
     */
    protected function setClientId($client_id)
    {
        $this->client_id = (int) $client_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiSecret()
    {
        return $this->api_secret;
    }

    /**
     * @param  string $api_secret
     * @return \Bitstamp\Api\Client
     */
    protected function setApiSecret($api_secret)
    {
        $this->api_secret = $api_secret;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param  string $api_key
     * @return \Bitstamp\Api\Client
     */
    protected function setApiKey($api_key)
    {
        $this->api_key = $api_key;

        return $this;
    }

    /**
     * Calculates a security signature for authenticating request to the API endpoints.
     *
     * @param  integer $nonce
     * @return string
     */
    protected function calculateSignature($nonce)
    {
        $signature = hash_hmac(
            "sha256",
            ($nonce . $this->getClientId() . $this->getApiKey()),
            $this->getApiSecret(),
            false
        );

        return mb_strtoupper($signature);
    }

    /**
     * Executes an HTTP request on an API endpoint.
     *
     * @param  \Bitstamp\Api\EndpointAbstract $endpoint
     * @param  string                         $method
     * @param  array                          $data
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function send(\Bitstamp\Api\EndpointAbstract $endpoint, $method, array $data = [])
    {
        $uri = (static::ENDPOINT_BASE_URI . $endpoint::URI);

        foreach ($data as $name => $value) {
            if (null === $value) {
                throw new \InvalidArgumentException("Missing value for required parameter: {$name}");
            }
        }

        $response = $this->getRequest()->send($method, $uri, $data, []);

        if ($response->isError()) {
            throw new \RuntimeException("HTTP error status received: {$response->getStatusCode()}");
        }

        return $response;
    }

    /**
     * Executes an HTTP GET request on an API endpoint.
     *
     * @param  \Bitstamp\Api\EndpointAbstract $endpoint
     * @param  array $data
     * @return \Bitstamp\Api\HttpResponse
     */
    public function get(\Bitstamp\Api\EndpointAbstract $endpoint, array $data = [])
    {
        $request = $this->getRequest();

        return $this->send($endpoint, $request::METHOD_GET, $data);
    }

    /**
     * Executes an HTTP POST request on an API endpoint. Authentication parameters are required for all POST requests.
     *
     * @param  \Bitstamp\Api\EndpointAbstract $endpoint
     * @param  array $data
     * @return \Bitstamp\Api\HttpResponse
     */
    public function post(\Bitstamp\Api\EndpointAbstract $endpoint, array $data = [])
    {
        $data["nonce"] = static::createNonce();
        $data["key"] = $this->getApiKey();
        $data["signature"] = $this->calculateSignature($data["nonce"]);

        $request = $this->getRequest();

        return $this->send($endpoint, $request::METHOD_POST, $data);
    }

    /**
     * Create a unique "number-once" integer.
     *
     * @return integer
     */
    protected static function createNonce()
    {
        return round(microtime(true) * 1000);
    }

}
