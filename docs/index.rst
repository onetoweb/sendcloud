.. title:: Index

Index
=====

.. contents::
    :local:


===========
Basic Usage
===========

Setup

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    use Onetoweb\Sendcloud\Client;
    
    // params
    $apiKey = 'api_key';
    $apiSecret = 'api_secret';
    $testModus = true;
    
    // setup client
    $client = new Client($apiKey, $apiSecret, $testModus);
    
    // (optional) set sendcloud partner id
    $client->setPartnerId('550e8400-e29b-41d4-a716-446655440000');


========
Examples
========


* `User <user.rst>`_
* `Returns <returns.rst>`_
* `Shipment <shipment.rst>`_
* `Compatibility <compatibility.rst>`_
* `Webhook <webhook.rst>`_
