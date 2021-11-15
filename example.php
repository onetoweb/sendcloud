<?php

require 'vendor/autoload.php';

use Onetoweb\Sendcloud\Client;

// params
$apiKey = 'api_key';
$apiSecret = 'api_secret';

// get client
$client = new Client($apiKey, $apiSecret);

// (optional) set too many requests callback
$client->setTooManyRequestsCallback(function() {
    
    // sleep for 60 seconds before repeating the request
    sleep(60);
    
    // return (bool) true if the request must repeated 
    return true;
    
});

// get parcels
$parcels = $client->get('parcels');

// follow next page link
$parcels = $client->get($parcels['next']);

// get parcel
$parcelId = 42;
$parcel = $client->get("parcels/$parcelId");

// create parcel
$parcel = $client->post('parcels', [
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

// create multiple parcels
$parcels = $client->post('parcels', [
    'parcels' => [[
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
    ], [
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
        'weight' => '8.000',
        'order_number' => '1234567891',
        'insured_value' => 500,
        'total_order_value' => '99.99',
        'total_order_value_currency' => 'EUR',
        'quantity' => 1,
        'shipping_method_checkout_name' => 'DPD Classic'
    ]]
]);

// pack & go creation request
$parcel = $client->post('parcels', [
    'parcel' => [
        'name' => 'Rob van den Heuvel',
        'company_name' => 'Sendcloud',
        'address' => 'Insulindelaan',
        'house_number' => '115',
        'city' => 'Eindhoven',
        'postal_code' => '5642CV',
        'country' => 'NL',
        'telephone' => '+31612345678',
        'request_label' => false,
        'email' => 'rob@sendcloud.nl',
        'order_number' => '1234567890',
        'parcel_items' => [
            [
                'description' => 'T-Shirt',
                'quantity' => 2,
                'weight' => '0.3',
                'sku' => 'sku1',
                'value' => '300',
                'properties' => [
                    'Size' => 'Medium',
                    'Color' => 'Blue'
                ]
            ], [
                'description' => 'Trousers',
                'quantity' => 1,
                'weight' => '0.3',
                'sku' => 'sku2',
                'value' => '100',
                'properties' => [
                    'Size' => '58',
                    'Color' => 'Black'
                ]
            ]
        ]
    ]
]);

// update parcel
$parcelId = 42;
$parcel = $client->put('parcels', [
    'parcel' => [
        'id' => $parcelId,
        'name' => 'Anna Tester',
        'company_name' => 'Summer Co',
        'request_label' => true
    ]
]);

// cancel / delete a parcel
$parcelId = 42;
$status = $client->post("parcels/$parcelId/cancel");

// return portal url
$parcelId = 42;
$result = $client->get("parcels/$parcelId/return_portal_url");

// get parcel document
$parcelId = 42;
$result = $client->get("parcels/$parcelId/documents/pdf", [
    'format' => 'pdf',
    'dpi' => '72'
]);

// get parcel statuses
$statuses = $client->get('parcels/statuses');

// create parcels report
$result = $client->post('reporting/parcels', [
    'fields' => [
        'parcel_id',
        'direction',
        'carrier_code',
        'arrived_at'
    ],
    'filters' => [
        'direction' => 'incoming',
        'integration_id' => 0,
        'updated_after' => '2019-08-24T14:15:22Z',
        'updated_before' => '2019-08-24T14:15:22Z',
        'announced_after' => '2019-08-24T14:15:22Z',
        'announced_before' => '2019-08-24T14:15:22Z'
    ]
]);

// get parcel report
$reportId = 42;
$report  = $client->get("reporting/parcels/$reportId");

// get returns
$returns = $client->get('returns');

// get return
$returnId = 42;
$return = $client->get("returns/$returnId");

// get brands
$brands = $client->get('brands');

// get brand
$brandId = 42;
$brand = $client->get("brands/$brandId");

// get shipping methods
$shippingMethods = $client->get('shipping_methods');

// get shipping method
$shippingMethodId = 42;
$shippingMethods = $client->get("shipping_methods/$shippingMethodId");

// get shipping price
$shippingMethodId = 8;
$shippingPrices = $client->get('shipping-price', [
    'shipping_method_id' => $shippingMethodId,
    'from_country' => 'NL',
    'to_country' => 'NL',
    'weight' => 1,
    'weight_unit' => 'kilogram'
]);

// get all shipping functionalities
$shippingFunctionalities = $client->get('shipping-functionalities');

// get shipping products
$shippingProducts = $client->get('shipping-products', [
    'from_country' => 'NL'
]);

// get label urls
$parcelId = 42;
$labels = $client->get("labels/$parcelId");

// get label data
$labelData = $client->get($labels['label']['normal_printer'][0]);

// create label file
$labelFile = '/path/to/filename.pdf';

// write data to file
file_put_contents($labelFile, $labelData);

// bulk pdf label printing
$labels = $client->post("labels", [
    'label' => [
        'parcels' => [
            42,
            43,
            44
        ]
    ]
]);


// get label data
$labelData = $client->get($labels['label']['normal_printer'][0]);

// create label file
$labelFile = '/path/to/filename.pdf';

// write data to file
file_put_contents($labelFile, $labelData);

// get user
$user = $client->get('user');

// get invoices
$invoices = $client->get('user/invoices');

// get invoice
$invoiceId = 42;
$invoice = $client->get("user/invoices/$invoiceId");

// get sender addresses
$senderAddresses = $client->get('user/addresses/sender');

// get sender address
$senderAddressId = 42;
$senderAddresses = $client->get("user/addresses/sender/$senderAddressId");

// get integrations
$integrations = $client->get('integrations');
