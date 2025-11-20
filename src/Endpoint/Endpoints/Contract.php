<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Contract Endpoint.
 */
class Contract extends AbstractEndpoint
{
    /**
     * @param int $pageSize = 100
     * @param int $offset = 0
     * @param bool $reverse = false
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function list(int $pageSize = 100, int $offset = 0, bool $reverse = false, array $query = []): ?array
    {
        $query['page_size'] = $pageSize;
        $query['cursor'] = $this->client->buildCursor($offset, $reverse);
        
        return $this->client->get('/contracts', $query);
    }
    
    /**
     * @param int $id
     * 
     * @return array|NULL
     */
    public function get($id): ?array
    {
        return $this->client->get("/contracts/$id");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/contracts', $data);
    }
    
    /**
     * @param int $id
     * @param array $data
     * 
     * @return array|NULL
     */
    public function update($id, array $data): ?array
    {
        return $this->client->patch("/contracts/$id", $data);
    }
    
    /**
     * @param int $id
     * 
     * @return array|NULL
     */
    public function delete($id): ?array
    {
        return $this->client->delete("/contracts/$id");
    }
    
    /**
     * @param string $carrierCode
     * 
     * @return array|NULL
     */
    public function listSchemas(string $carrierCode): ?array
    {
        $query['carrier_code'] = $carrierCode;
        
        return $this->client->get('/contracts/schemas', $query);
    }
}
