<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Integration Endpoint.
 */
class Integration extends AbstractEndpoint
{
    /**
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function list(array $query = []): ?array
    {
        return $this->client->get('/integrations', $query);
    }
    
    /**
     * @param int $integrationId
     * 
     * @return array|NULL
     */
    public function get(int $integrationId): ?array
    {
        return $this->client->get("/integrations/$integrationId");
    }
    
    /**
     * @param int $integrationId
     * @param array $data
     * 
     * @return array|NULL
     */
    public function update(int $integrationId, array $data): ?array
    {
        return $this->client->patch("/integrations/$integrationId", $data);
    }
    
    /**
     * @param int $integrationId
     * 
     * @return array|NULL
     */
    public function delete(int $integrationId): ?array
    {
        return $this->client->delete("/integrations/$integrationId");
    }
    
    /**
     * @param int $integrationId
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function getOrderStatuses(int $integrationId, array $query = []): ?array
    {
        $query['integration_id'] = $integrationId;
        
        return $this->client->get('/shop-order-statuses', $query);
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function createOrderStatus(array $data): ?array
    {
        return $this->client->post('/shop-order-statuses', $data);
    }
    
    /**
     * @param int $integrationId
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function getOrderStatusesMapping(int $integrationId, array $query = []): ?array
    {
        $query['integration_id'] = $integrationId;
        
        return $this->client->get('/shop-order-statuses/mapping', $query);
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function updateOrderStatusesMapping(array $data): ?array
    {
        return $this->client->post('/shop-order-statuses/mapping/', $data);
    }
}
