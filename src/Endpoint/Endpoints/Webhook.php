<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;
use Symfony\Component\HttpFoundation\Request;

/**
 * Webhook Endpoint.
 */
class Webhook extends AbstractEndpoint
{
    /**
     * @return bool
     */
    public function verify(): bool
    {
        $request = Request::createFromGlobals();
        
        if ($request->headers->has('sendcloud-signature')) {
            
            $sendcloudSignature = $request->headers->get('sendcloud-signature');
            
            $signature = hash_hmac('sha256', $request->getContent(), $this->client->getApiSecret());
            
            return assert($sendcloudSignature == $signature);
        }
        
        return false;
    }
    
    /**
     * @return array|NULL
     */
    public function data(): ?array
    {
        $request = Request::createFromGlobals();
        
        return json_decode($request->getContent(), true);
    }
}
