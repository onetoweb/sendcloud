<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Order Label Endpoint.
 */
class OrderLabel extends AbstractEndpoint
{
    /**
     * @param array $data
     *
     * @return array|NULL
     */
    public function getAsync(array $data): ?array
    {
        return $this->client->post('/orders/create-labels-async', $data);
    }
    
    /**
     * @param array $data
     *
     * @return array|NULL
     */
    public function getSync(array $data): ?array
    {
        return $this->client->post('/orders/create-label-sync', $data);
    }
}
