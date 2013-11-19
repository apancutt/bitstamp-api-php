<?php
namespace Bitstamp\Api;

class Client
{

    private $logger;
    private $client_id;
    private $api_secret;
    private $api_key;
    private $nonce;

    const VERSION = "0.0.1";
    const ENDPOINT_BASE_URI = "https://www.bitstamp.net/api";

    /**
     * @param string                        $client_id
     * @param string                        $api_secret
     * @param string                        $api_key
     * @param \Bitstamp\Api\LoggerInterface $logger
     */
    public function __construct($client_id, $api_secret, $api_key, \Bitstamp\Api\LoggerInterface $logger = null)
    {
        $this
            ->setClientId($client_id)
            ->setApiSecret($api_secret)
            ->setApiKey($api_key)
            ->setNonce(static::createNonce());

        if (null !== $logger) {
            $this->setLogger($logger);

            $logger->debug("Bitstamp client has been configured:");
            $logger->debug("     Client ID: {$this->getClientId()}");
            $logger->debug("     API Secret: <hidden>");
            $logger->debug("     API Key: {$this->getApiKey()}");
            $logger->debug("     Nonce: {$this->getNonce()}");
        }
    }

    /**
     * @return \Bitstamp\Api\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @return boolean
     */
    public function hasLogger()
    {
        return (null !== $this->getLogger());
    }

    /**
     * @param  \Bitstamp\Api\LoggerInterface $logger
     * @return \Bitstamp\Api\Client
     */
    protected function setLogger(\Bitstamp\Api\LoggerInterface $logger = null)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return \Bitstamp\Api\Client
     */
    protected function removeLogger()
    {
        return $this->setLogger(null);
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
     * @return integer
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param  integer $nonce
     * @return \Bitstamp\Api\Client
     */
    protected function setNonce($nonce)
    {
        $this->nonce = (int) $nonce;

        return $this;
    }

    /**
     * Calculates a security signature for authenticating request to the API endpoints.
     *
     * @return string
     */
    protected function calculateSignature()
    {
        $signature = hash_hmac(
            "sha256",
            ($this->getNonce() . $this->getClientId() . $this->getApiKey()),
            $this->getApiSecret(),
            false
        );

        return mb_strtoupper($signature);
    }

    /**
     * Executes an HTTP request on an API endpoint.
     *
     * @param  string $method
     * @param  string $uri
     * @param  array $data
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return \Bitstamp\Api\HttpResponse
     */
    protected function send($method, $uri, array $data = [])
    {
        $uri = (static::ENDPOINT_BASE_URI . $uri);

        foreach ($data as $name => $value) {
            if (null === $value) {
                throw new \InvalidArgumentException("Missing value for required parameter: {$name}");
            }
        }

        $options = [
            CURLOPT_USERAGENT => sprintf(
                "Mozilla/4.0 (compatible; BtcTrader/%s; %s; PHP/%s)", static::VERSION, php_uname("s"), phpversion()
            )
        ];

        $http_request = new \Bitstamp\Api\HttpRequest($this->getLogger());

        $http_response = $http_request->send($method, $uri, $data, [], $options);

        if ($http_response->isError()) {
            throw new \RuntimeException("HTTP error status received: {$http_response->getStatusCode()}");
        }

        return $http_response;
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
        return $this->send(\Bitstamp\Api\HttpRequest::METHOD_GET, $endpoint::URI, $data);
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
        $data["nonce"] = $this->getNonce();
        $data["key"] = $this->getApiKey();
        $data["signature"] = $this->calculateSignature();

        return $this->send(\Bitstamp\Api\HttpRequest::METHOD_POST, $endpoint::URI, $data);
    }

    /**
     * Create a unique "number-once" integer.
     *
     * @return integer
     */
    protected static function createNonce()
    {
        return time();
    }

}
