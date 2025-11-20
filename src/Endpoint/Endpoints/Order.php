<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Order Endpoint.
 */
class Order extends AbstractEndpoint
{
    /**
     * @param int $pageSize = 40
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
        
        return $this->client->get('/orders', $query);
    }
    
    /**
     * @param int $id
     * 
     * @return array|NULL
     */
    public function get(int $id): ?array
    {
        return $this->client->get("/orders/$id");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/orders', $data);
    }
    
    /**
     * @param int $id
     * @param array $data
     * 
     * @return array|NULL
     */
    public function update(int $id, array $data): ?array
    {
        return $this->client->patch("/orders/$id", $data);
    }
    
    /**
     * @param int $id
     * 
     * @return array|NULL
     */
    public function delete(int $id): ?array
    {
        return $this->client->delete("/orders/$id");
    }
}
