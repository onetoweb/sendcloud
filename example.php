<?php

require 'vendor/autoload.php';

use Onetoweb\Sendcloud\Client;

// param
$apiKey = 'api_key';
$apiSecret = 'api_secret';

// get client
$client = new Client($apiKey, $apiSecret);

// create parcel
$parcel = $client->request(Client::METHOD_POST, 'parcels', [
    'parcel' => [
        'name' => 'John Doe',
        'company_name' => 'Sendcloud',
        'address' => 'Insulindelaan',
        'house_number' => '115',
        'city' => 'Eindhoven',
        'postal_code' => '5642CV',
        'telephone' => '+31612345678',
        'request_label' => true,
        'email' => 'john@doe.com',
        'data' => [],
        'country' => 'NL',
        'shipment' => [
            'id' => 8
        ],
        'weight' => '10.000',
        'order_number' => '1234567890',
        'insured_value' => 2000,
        'total_order_value_currency' => 'GBP',
        'total_order_value' => '11.11',
        'quantity' => 1,
        'shipping_method_checkout_name' => 'DHL Express Domestic'
    ]
]);

// get label urls
$parcelId = 42;
$labels = $client->request(Client::METHOD_GET, "labels/$parcelId");

// get label data
$labelData = $client->request(Client::METHOD_GET, $labels['label']['normal_printer'][0]);

// create label file
$labelFile = '/path/to/filename.pdf';

// write data to file
file_put_contents($labelFile, $labelData);