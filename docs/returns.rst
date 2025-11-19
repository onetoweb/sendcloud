.. _top:
.. title:: Returns

`Back to index <index.rst>`_

=======
Returns
=======

.. contents::
    :local:


List returns
````````````

.. code-block:: php
    
    $result = $client->returns->list([
        
        // optional parameters
        'from_date' => '2022-04-06 00:00:00',
        'to_date' => '2022-04-07 00:00:00',
        'page_size' => 10,
        'parent_parcel_status' => 'announced'
    ]);


List all return pages
`````````````````````

.. code-block:: php
    
    do {
        
        $result = $client->returns->list([
            'from_date' => '2022-04-06 00:00:00',
            'to_date' => '2022-04-07 00:00:00',
            'cursor' => $client->getNextCursor(),
            'page_size' => 10,
            'parent_parcel_status' => 'announced'
        ]);
        
    } while($client->getNextCursor() !== null);


Get return by id
````````````````

.. code-block:: php
    
    $returnId = 1751075;
    $result = $client->returns->get($returnId);


Create return
`````````````

.. code-block:: php
    
    $result = $client->returns->create([
        'from_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'to_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'ship_with' => [
            'type' => 'shipping_option_code',
            'shipping_option_code' => 'dpd:return/return',
            'contract' => 123456
        ],
        'dimensions' => [
            'height' => 10,
            'width' => 10,
            'length' => 10,
            'unit' => 'cm'
        ],
        'weight' => [
            'value' => 0.4,
            'unit' => 'kg'
        ],
        'collo_count' => 1,
        'parcel_items' => [
            [
                'description' => 'T-Shirt XL',
                'quantity' => 1,
                'weight' => [
                    'value' => 0.4,
                    'unit' => 'kg'
                ],
                'value' => [
                    'value' => 6.15,
                    'currency' => 'EUR'
                ],
                'hs_code' => '6205.20',
                'origin_country' => 'NL',
                'sku' => 'TS1234',
                'product_id' => '19283'
            ]
        ],
        'send_tracking_emails' => false,
        'brand_id' => 1,
        'total_insured_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'order_number' => 'ORD123456',
        'total_order_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'external_reference' => 'RET98765',
        'customs_invoice_nr' => 'test_invoice_123',
        'delivery_option' => 'drop_off_point'
    ]);


Cancel return
`````````````

.. code-block:: php
    
    $returnId = 1751075;
    $result = $client->returns->cancel($returnId);


Validate return
```````````````

.. code-block:: php
    
    $result = $client->returns->validate([
        'from_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'to_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'ship_with' => [
            'type' => 'shipping_option_code',
            'shipping_option_code' => 'dpd:return/return',
            'contract' => 123456
        ],
        'dimensions' => [
            'height' => 10,
            'width' => 10,
            'length' => 10,
            'unit' => 'cm'
        ],
        'weight' => [
            'value' => 0.4,
            'unit' => 'kg'
        ],
        'collo_count' => 1,
        'parcel_items' => [
            [
                'description' => 'T-Shirt XL',
                'quantity' => 1,
                'weight' => [
                    'value' => 0.4,
                    'unit' => 'kg'
                ],
                'value' => [
                    'value' => 6.15,
                    'currency' => 'EUR'
                ],
                'hs_code' => '6205.20',
                'origin_country' => 'NL',
                'sku' => 'TS1234',
                'product_id' => '19283'
            ]
        ],
        'send_tracking_emails' => false,
        'brand_id' => 1,
        'total_insured_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'order_number' => 'ORD123456',
        'total_order_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'external_reference' => 'RET98765',
        'customs_invoice_nr' => 'test_invoice_123',
        'delivery_option' => 'drop_off_point'
    ]);


Create return synchronously
```````````````````````````

.. code-block:: php
    
    $result = $client->returns->createSynchronously([
        'from_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'to_address' => [
            'name' => 'My name',
            'company_name' => 'Sendcloud',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '50',
            'postal_code' => '1013 AB',
            'city' => 'Amsterdam',
            'country_code' => 'NL',
            'phone_number' => '+319881729999',
            'email' => 'test@test.com'
        ],
        'ship_with' => [
            'type' => 'shipping_option_code',
            'shipping_option_code' => 'dpd:return/return',
            'contract' => 123456
        ],
        'dimensions' => [
            'height' => 10,
            'width' => 10,
            'length' => 10,
            'unit' => 'cm'
        ],
        'weight' => [
            'value' => 0.4,
            'unit' => 'kg'
        ],
        'collo_count' => 1,
        'parcel_items' => [
            [
                'description' => 'T-Shirt XL',
                'quantity' => 1,
                'weight' => [
                    'value' => 0.4,
                    'unit' => 'kg'
                ],
                'value' => [
                    'value' => 6.15,
                    'currency' => 'EUR'
                ],
                'hs_code' => '6205.20',
                'origin_country' => 'NL',
                'sku' => 'TS1234',
                'product_id' => '19283'
            ]
        ],
        'send_tracking_emails' => false,
        'brand_id' => 1,
        'total_insured_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'order_number' => 'ORD123456',
        'total_order_value' => [
            'value' => 6.15,
            'currency' => 'EUR'
        ],
        'external_reference' => 'RET98765',
        'customs_invoice_nr' => 'test_invoice_123',
        'delivery_option' => 'drop_off_point'
    ]);


`Back to top <#top>`_