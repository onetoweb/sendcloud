<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Returns Endpoint.
 */
class Returns extends AbstractEndpoint
{
    /**
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function list(array $query = []): ?array
    {
        return $this->client->get('/returns', $query);
    }
    
    /**
     * @param int $returnId
     * 
     * @return array|NULL
     */
    public function get(int $returnId): ?array
    {
        return $this->client->get("/returns/$returnId");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/returns', $data);
    }
    
    /**
     * @param int $returnId
     * 
     * @return array|NULL
     */
    public function cancel(int $returnId): ?array
    {
        return $this->client->patch("/returns/$returnId/cancel");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function validate(array $data): ?array
    {
        return $this->client->post('/returns/validate', $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function createSynchronously(array $data): ?array
    {
        return $this->client->post('/returns/announce-synchronously', $data);
    }
}
