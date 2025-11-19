<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Sender Address Endpoint.
 */
class SenderAddress extends AbstractEndpoint
{
    /**
     * @param int $pageSize = 100
     * @param int $offset = 0
     * @param bool $reverse = false
     * 
     * @return array|NULL
     */
    public function list(int $pageSize = 40, int $offset = 0, bool $reverse = false): ?array
    {
        $query['page_size'] = $pageSize;
        $query['cursor'] = $this->client->buildCursor($offset, $reverse);
        
        return $this->client->get('/addresses/sender-addresses', $query);
    }
    
    /**
     * @param int $addressId
     * 
     * @return array|NULL
     */
    public function get(int $addressId): ?array
    {
        return $this->client->get("/addresses/sender-addresses/$addressId");
    }
}
