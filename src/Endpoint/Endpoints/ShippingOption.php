<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Shipping Option Endpoint.
 */
class ShippingOption extends AbstractEndpoint
{
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function list(array $data): ?array
    {
        return $this->client->post('/shipping-options', $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array|NULL
     */
    public function create(array $data): ?array
    {
        return $this->client->post('/fetch-shipping-options', $data);
    }
}
