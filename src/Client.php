<?php

namespace Onetoweb\Sendcloud;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Sendcloud Api CLient.
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @see https://docs.sendcloud.sc/api/v2/shipping/
 */
class Client
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_HEAD = 'HEAD';
    const METHOD_OPTIONS = 'OPTIONS';
    
    const BASE_HREF = 'https://panel.sendcloud.sc/api';
    const VERSION = 'v2';
    
    /**
     * @var string
     */
    private $apiKey;
    
    /**
     * @var string
     */
    private $apiSecret;
    
    /**
     * @var string
     */
    private $version;
    
    /**
     * @var callable
     */
    private $tooManyRequestsCallback;
    
    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param string $version = self::VERSION
     */
    public function __construct(string $apiKey, string $apiSecret, string $version = self::VERSION)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->version = $version;
    }
    
    /**
     * Get uri & extract query params
     * 
     * @param string $endpoint
     * @param array &$query = []
     * 
     * @return string
     */
    private function getUri(string $endpoint, array &$query = []): string
    {
        // extract query params
        $queryString = parse_url($endpoint, PHP_URL_QUERY);
        parse_str($queryString, $queryArray);
        
        // merge query params
        $query = array_merge($queryArray, $query);
        
        // remove query string from endpoint
        $endpoint = str_replace("?$queryString", '', $endpoint);
        
        // build base uri
        $baseUri = self::BASE_HREF.'/'.$this->version;
        
        // add endpoint to base uri
        if(strpos($endpoint, $baseUri) === false){
            $uri = "$baseUri/$endpoint";
        } else {
            $uri = $endpoint;
        }
        
        return urldecode($uri);
    }
    
    /**
     * @param callable $tooManyRequestsCallback
     */
    public function setTooManyRequestsCallback(callable $tooManyRequestsCallback): void
    {
        $this->tooManyRequestsCallback = $tooManyRequestsCallback;
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * @param array $headers = []
     *
     * @return mixed
     */
    public function get(string $endpoint, array $query = [], array $headers = [])
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query, $headers);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param array $headers = []
     *
     * @return mixed
     */
    public function post(string $endpoint, array $data = [], array $query = [], array $headers = [])
    {
        return $this->request(self::METHOD_POST, $endpoint, $data, $query, $headers);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param array $headers = []
     *
     * @return mixed
     */
    public function put(string $endpoint, array $data = [], array $query = [], array $headers = [])
    {
        return $this->request(self::METHOD_PUT, $endpoint, $data, $query, $headers);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * @param array $headers = []
     *
     * @return mixed
     */
    public function options(string $endpoint, array $query = [], array $headers = [])
    {
        return $this->request(self::METHOD_OPTIONS, $endpoint, [], $query, $headers);
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param array $headers = []
     * 
     * @return mixed
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [], array $headers = [])
    {
        // build headers
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);
        
        // setup options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => $headers,
            RequestOptions::AUTH => [
                $this->apiKey,
                $this->apiSecret
            ]
        ];
        
        // add data
        if (in_array($method, [self::METHOD_POST, self::METHOD_PUT])) {
            $options[RequestOptions::JSON] = $data;
        }
        
        // get uri & extract query from endpoint string
        $uri = $this->getUri($endpoint, $query);
        
        // add query
        $options[RequestOptions::QUERY] = $query;
        
        // make request
        $response = (new GuzzleClient())->request($method, $uri, $options);
        
        // handle 429 - too many requests
        if ($response->getStatusCode() === 429) {
            
            if ($this->tooManyRequestsCallback !== null) {
                
                // execute too many request callback
                if (($this->tooManyRequestsCallback)() === true) {
                    
                    // retry request
                    $response = (new GuzzleClient())->request($method, $uri, $options);
                }
            }
        }
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        if ($response->getHeaderLine('Content-Type') == 'application/json') {
            return json_decode($contents, true);
        } else {
            return $contents;
        }
    }
}