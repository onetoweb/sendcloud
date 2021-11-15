<?php

require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// get api secret
$apiSecret = 'api_secret';

// create symfony request object
$request = Request::createFromGlobals();

// get content
$content = $request->getContent();

// get content signature 
$contentSignature = hash_hmac('sha256', $content, $apiSecret);

// get sendcloud signature from request header
$sendcloudSignature = $request->headers->get('Sendcloud-Signature');

// check signature hashes
if (hash_equals($contentSignature, $sendcloudSignature)) {
    
    // signatures match content is valid
    
    // decode json content
    $data = json_decode($content);
    
    // return 200 ok response
    $response = new Response();
    $response->setStatusCode(Response::HTTP_OK);
    $response->send();
    
} else {
    
    // signatures do not match content is not valid
    
    // return 400 bad request response
    $response = new Response();
    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
    $response->send();
}
