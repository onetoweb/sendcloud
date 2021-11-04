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
     * @param string $endpoint
     *
     * @return string
     */
    private function getUrl(string $endpoint): string
    {
        $baseUri = self::BASE_HREF . '/' . $this->version;
        
        if(strpos($endpoint, $baseUri) === false){
            
            return $baseUri . '/' . $endpoint;
            
        } else {
            return $endpoint;
        }
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return mixed array|null|string
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [])
    {
        $options = [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
            ],
            RequestOptions::QUERY => $query,
            RequestOptions::AUTH => [
                $this->apiKey,
                $this->apiSecret
            ]
        ];
        
        if (in_array($method, [self::METHOD_POST, self::METHOD_PUT])) {
            $options[RequestOptions::JSON] = $data;
        }
        
        try {
            
            $response  = (new GuzzleClient())->request($method, $this->getUrl($endpoint), $options);
            
            $contents = $response->getBody()->getContents();
            
            if ($response->getHeaderLine('Content-Type') == 'application/json') {
                return json_decode($contents, true);
            } else {
                return $contents;
            }
            
        } catch (RequestException $requestException) {
            
            if ($requestException->hasResponse()) {
                
                $contents = $requestException->getResponse()->getBody()->getContents();
                
                return json_decode($contents, true);
            }
            
            return [
                'message' => 'no response'
            ];
        }
    }
}