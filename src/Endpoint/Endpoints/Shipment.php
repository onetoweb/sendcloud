<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Shipment Endpoint.
 */
class Shipment extends AbstractEndpoint
{
    /**
     * @param int $pageSize = 40
     * @param int $offset = 0
     * @param bool $reverse = false
     * @param array $query = []
     * 
     * @return array|NULL
     */
    public function list(int $pageSize = 40, int $offset = 0, bool $reverse = false, array $query = []): ?array
    {
        $query['page_size'] = $pageSize;
        $query['cursor'] = $this->client->buildCursor($offset, $reverse);
        
        return $this->client->get('/shipments', $query);
    }
    
    /**
     * @param string $shipmentId
     * 
     * @return array|NULL
     */
    public function get(string $shipmentId): ?array
    {
        return $this->client->get("/shipments/$shipmentId");
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/shipments', $data);
    }
    
    /**
     * @param array $data
     *
     * @return array|NULL
     */
    public function createWithShippingRules(array $data): ?array
    {
        return $this->client->post('/shipments/announce-with-shipping-rules', $data);
    }
    
    /**
     * @param string $shipmentId
     * 
     * @return array|NULL
     */
    public function cancel(string $shipmentId): ?array
    {
        return $this->client->post("/shipments/$shipmentId/cancel");
    }
}
