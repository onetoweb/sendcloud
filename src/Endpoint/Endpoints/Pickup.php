<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Pickup Endpoint.
 */
class Pickup extends AbstractEndpoint
{
    /**
     * @return array|NULL
     */
    public function list(): ?array
    {
        return $this->client->get('/pickups');
    }
    
    /**
     * @param string $pickupId
     * 
     * @return array|NULL
     */
    public function get(string $pickupId): ?array
    {
        return $this->client->get("/pickups/$pickupId");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/pickups', $data);
    }
}
