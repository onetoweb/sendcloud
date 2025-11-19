.. _top:
.. title:: Shipment

`Back to index <index.rst>`_

========
Shipment
========

.. contents::
    :local:


Get last 100 shipments
``````````````````````

.. code-block:: php
    
    $result = $client->shipment->list(100);


Get shipments
`````````````

.. code-block:: php
    
    $limit = 40;
    $offset = 0;
    $reverse = false;
    $result = $client->shipment->list($limit, $offset, $reverse, [
        
        // optional filters
        'announced_after' => '2018-02-26T11:01:47.505309+00:00',
        'announced_before' => '2018-02-26T11:01:47.505309+00:00',
        'external_reference_id' => '12345',
        'ids' => '13579,24680,12345',
        'integration_id' => '12345',
        'order_number' => '12345',
        'parcel_status' => 'ANNOUNCED',
        'tracking_number' => '12345',
        'updated_after' => '2018-02-26T11:01:47.505309+00:00',
        'updated_before' => '2018-02-26T11:01:47.505309+00:00'
    ]);


Get shipment by id
``````````````````

.. code-block:: php
    
    $shipmentId = 'XXX-Shipment-id';
    $result = $client->shipment->get($shipmentId);


Create shipment
```````````````

.. code-block:: php
    
    $result = $client->shipment->create([
        'label_details' => [
            'mime_type' => 'application/pdf',
            'dpi' => 72
        ],
        'to_address' => [
            'name' => 'John Doe',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Insulindelaan 115',
            'house_number' => '115',
            'postal_code' => '5642CV',
            'city' => 'Eindhoven',
            'country_code' => 'NL',
            'phone_number' => '+31612345678',
            'email' => 'john.doe@sendcloud.com',
            'po_box' => 'PO Box 678'
        ],
        'from_address' => [
            'name' => 'Marie Doe',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein 10',
            'address_line_2' => '2e verdieping',
            'house_number' => '10',
            'postal_code' => '5611 EM',
            'city' => 'Eindhoven',
            'country_code' => 'NL',
            'phone_number' => '+31612345678',
            'email' => 'marie.doe@sendcloud.com',
            'po_box' => 'PO Box 478'
        ],
        'ship_with' => [
            'type' => 'shipping_option_code',
            'properties' => [
                'shipping_option_code' => 'postnl:standard',
                'contract_id' => 517
            ]
        ],
        'order_number' => '1234567890',
        'total_order_price' => [
            'currency' => 'EUR',
            'value' => '11.11'
        ],
        'parcels' => [
            [
                'dimensions' => [
                    'length' => '5.00',
                    'width' => '15.00',
                    'height' => '20.00',
                    'unit' => 'cm'
                ],
                'weight' => [
                    'value' => '1.320',
                    'unit' => 'kg'
                ],
                'label_notes' => [
                    'I live at the blue door',
                    'The doorbell isn’t working'
                ],
                'parcel_items' => [
                    [
                        'item_id' => '5552',
                        'description' => 'T-Shirt XL',
                        'quantity' => 1,
                        'weight' => [
                            'value' => 0.3,
                            'unit' => 'kg'
                        ],
                        'price' => [
                            'value' => 12.65,
                            'currency' => 'EUR'
                        ],
                        'hs_code' => '620520',
                        'origin_country' => 'NL',
                        'sku' => 'TS1234',
                        'product_id' => '19284',
                        'mid_code' => 'NLOZR92MEL',
                        'material_content' => '100% Cotton',
                        'intended_use' => 'Personal use',
                        'properties' => [
                            'size' => 'XL',
                            'color' => 'green'
                        ]
                    ]
                ]
            ]
        ]
    ]);


Create shipment with shipping rules
```````````````````````````````````

.. code-block:: php
    
    $result = $client->shipment->createWithShippingRules([
        'apply_shipping_defaults' => true,
        'apply_shipping_rules' => true,
        'delivery_indicator' => 'DHL home delivery',
        'to_address' => [
            'name' => 'John Doe',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Insulindelaan 115',
            'house_number' => '115',
            'postal_code' => '5642CV',
            'city' => 'Eindhoven',
            'country_code' => 'NL',
            'phone_number' => '+31612345678',
            'email' => 'john.doe@sendcloud.com',
            'po_box' => 'PO Box 678'
        ],
        'from_address' => [
            'name' => 'Marie Doe',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein 10',
            'address_line_2' => '2e verdieping',
            'house_number' => '10',
            'postal_code' => '5611 EM',
            'city' => 'Eindhoven',
            'country_code' => 'NL',
            'phone_number' => '+31612345678',
            'email' => 'marie.doe@sendcloud.com',
            'po_box' => 'PO Box 478'
        ],
        'ship_with' => [
            'type' => 'shipping_option_code',
            'properties' => [
                'shipping_option_code' => 'postnl:standard',
                'contract_id' => 517
            ]
        ],
        'order_number' => '1234567890',
        'total_order_price' => [
            'currency' => 'EUR',
            'value' => '11.11'
        ],
        'parcels' => [
            [
                'dimensions' => [
                    'length' => '5.00',
                    'width' => '15.00',
                    'height' => '20.00',
                    'unit' => 'cm'
                ],
                'weight' => [
                    'value' => '1.320',
                    'unit' => 'kg'
                ],
                'parcel_items' => [
                    [
                        'item_id' => '5552',
                        'description' => 'T-Shirt XL',
                        'quantity' => 1,
                        'weight' => [
                            'value' => 0.3,
                            'unit' => 'kg'
                        ],
                        'price' => [
                            'value' => 12.65,
                            'currency' => 'EUR'
                        ],
                        'hs_code' => '620520',
                        'origin_country' => 'NL',
                        'sku' => 'TS1234',
                        'product_id' => '19284',
                        'mid_code' => 'NLOZR92MEL',
                        'material_content' => '100% Cotton',
                        'intended_use' => 'Personal use',
                        'properties' => [
                            'size' => 'XL',
                            'color' => 'green'
                        ]
                    ]
                ]
            ]
        ]
    ]);


Cancel shipment by id
`````````````````````

.. code-block:: php
    
    $shipmentId = 'XXX-Shipment-id';
    $result = $client->shipment->cancel($shipmentId);


`Back to top <#top>`_