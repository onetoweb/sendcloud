<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Compatibility Endpoint.
 */
class Compatibility extends AbstractEndpoint
{
    /**
     * @param array $shippingMethodIds
     * 
     * @return array|NULL
     */
    public function list(array $shippingMethodIds): ?array
    {
        return $this->client->post('/compat/shipping-options', [
            'shipping_method_ids' => $shippingMethodIds
        ]);
    }
}
