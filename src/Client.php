<?php

namespace Onetoweb\Sendcloud;

use Onetoweb\Sendcloud\Endpoint\Endpoints;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use GuzzleHttp\Psr7\Query;

/**
 * Sendcloud Api Client.
 */
#[\AllowDynamicProperties]
class Client
{
    /**
     * Base href
     */
    public const BASE_HREF_TEST = 'https://stoplight.io/mocks/sendcloud/sendcloud-public-api/475741403';
    public const BASE_HREF_LIVE = 'https://panel.sendcloud.sc/api/v3';
    
    /**
     * Methods.
     */
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';
    
    /**
     * @var string
     */
    private $apiKey;
    
    /**
     * @var string
     */
    private $apiSecret;
    
    /**
     * @var bool
     */
    private $testModus;
    
    /**
     * @var string
     */
    private $partnerId;
    
    /**
     * @var string
     */
    private $previousCursor;
    
    /**
     * @var string
     */
    private $nextCursor;
    
    /**
     * @param string $apiKey
     * @param bool $testModus = true
     */
    public function __construct(string $apiKey, string $apiSecret, bool $testModus = true)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->testModus = $testModus;
        
        // load endpoints
        $this->loadEndpoints();
    }
    
    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }
    
    /**
     * @param string $partnerId
     * 
     * @return void
     */
    public function setPartnerId(string $partnerId): void
    {
        $this->partnerId = $partnerId;
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        foreach (Endpoints::list() as $name => $class) {
            $this->{$name} = new $class($this);
        }
    }
    
    /**
     * @return string
     */
    public function getBaseHref(): string
    {
        return $this->testModus ? self::BASE_HREF_TEST : self::BASE_HREF_LIVE;
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    public function getUrl(string $endpoint): string
    {
        return $this->getBaseHref() . '/' . ltrim($endpoint, '/');
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * @param array $extraHeaders = []
     * 
     * @return array|NULL
     */
    public function get(string $endpoint, array $query = [], array $extraHeaders = []): ?array
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query, $extraHeaders);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|NULL
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_POST, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|NULL
     */
    public function patch(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_PATCH, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return array|NULL
     */
    public function delete(string $endpoint): ?array
    {
        return $this->request(self::METHOD_DELETE, $endpoint);
    }
    
    /**
     * @param int $ofsset = 0
     * @param bool $reverse = false
     * 
     * @return string
     */
    public function buildCursor(int $ofsset = 0, bool $reverse = false): string
    {
        return base64_encode(http_build_query([
            'o' => $ofsset,
            'r' => $reverse,
        ]));
    }
    
    /**
     * @param string $url
     * 
     * @return string|NULL
     */
    private function getUrlCursor(string $url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        
        if (isset($query['cursor'])) {
            return $query['cursor'];
        }
        
        return null;
    }
    
    /**
     * @return string|NULL
     */
    public function getPreviousCursor(): ?string
    {
        return $this->previousCursor;
    }
    
    /**
     * @return string|NULL
     */
    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param array $extraHeaders = []
     * 
     * @return array|NULL
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [], array $extraHeaders = []): ?array
    {
        // build headers
        $headers = [
            'Accept' => 'application/json'
        ];
        
        if ($this->partnerId !== null) {
            $headers['Sendcloud-Partner-Id'] = $this->partnerId;
        }
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => array_merge($headers, $extraHeaders),
            RequestOptions::AUTH => [
                $this->apiKey,
                $this->apiSecret
            ],
            RequestOptions::QUERY => Query::build($query),
        ];
        
        if (count($data) > 0) {
            $options[RequestOptions::JSON] = $data;
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method, $this->getUrl($endpoint), $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        // return json content
        if (str_starts_with($response->getHeaderLine('content-type'), 'application/json')) {
        
            // decode json
            $json = json_decode($contents, true);
            
            // get previous cursor
            $this->previousCursor = null;
            if (isset($json['previous'])) {
                $this->previousCursor = $this->getUrlCursor($json['previous']);
            }
            
            // get next cursor
            $this->nextCursor = null;
            if (isset($json['next'])) {
                $this->nextCursor = $this->getUrlCursor($json['next']);
            }
            
        } elseif (in_array($response->getHeaderLine('content-type'), ['application/pdf', 'application/zpl', 'image/png'])) {
            
            // encode file contents
            $json = [
                'content_type' => $response->getHeaderLine('content-type'),
                'data' => base64_encode($contents)
            ];
            
        } else {
            $json = null;
        }
        
        return $json;
    }
}
