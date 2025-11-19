<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * User Endpoint.
 */
class User extends AbstractEndpoint
{
    /**
     * @return array|NULL
     */
    public function metadata(): ?array
    {
        return $this->client->get('/user/auth/metadata');
    }
}
