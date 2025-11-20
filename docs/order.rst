.. _top:
.. title:: Contract

`Back to index <index.rst>`_

========
Contract
========

.. contents::
    :local:


Retrieve orders from integrations
`````````````````````````````````

.. code-block:: php
    
    $result = $client->order->list();


Retrieve orders from integrations (pagination)
``````````````````````````````````````````````

.. code-block:: php
    
    $limit = 100;
    $offset = 0;
    $reverse = false;
    $result = $client->order->list($limit, $offset, $reverse, [
        
        // optional filters
        'integration' => '',
        'order_created_at' => '',
        'order_created_at_max' => '',
        'order_created_at_min' => '',
        'order_id' => '',
        'order_number' => '',
        'order_updated_at' => '',
        'order_updated_at_max' => '',
        'order_updated_at_min' => '',
        'sort' => '',
        'status' => '',
    ]);


Retrieving a specific order
```````````````````````````

.. code-block:: php
    
    $orderId = 12345;
    $result = $client->order->get($orderId);


Create/Update orders in batch
`````````````````````````````

.. code-block:: php
    
    $result = $client->order->create([
        [
            'order_id' => '555413',
            'order_number' => 'OXSDFGHTD-12',
            'order_details' => [
                'integration' => [
                    'id' => 7
                ],
                'status' => [
                    'code' => 'fulfilled',
                    'message' => 'Fulfilled'
                ],
                'order_created_at' => '2018-02-27T10:00:00.556Z',
                'order_items' => [
                    [
                        'name' => 'Cylinder candle',
                        'quantity' => 1,
                        'total_price' => [
                            'value' => 3.5,
                            'currency' => 'EUR'
                        ]
                    ]
                ]
            ],
            'payment_details' => [
                'total_price' => [
                    'value' => 3.5,
                    'currency' => 'EUR'
                ],
                'status' => [
                    'code' => 'paid',
                    'message' => 'Paid'
                ]
            ],
            'shipping_address' => [
                'name' => 'John Doe',
                'address_line_1' => 'Lansdown Glade',
                'house_number' => '15',
                'postal_code' => '5341XT',
                'city' => 'Oss',
                'country_code' => 'NL'
            ],
            'shipping_details' => [
                'is_local_pickup' => false,
                'delivery_indicator' => 'DHL home delivery',
                'measurement' => [
                    'weight' => [
                        'value' => 3,
                        'unit' => 'kg'
                    ]
                ]
            ]
        ]
    ]);


Update an order
```````````````

.. code-block:: php
    
    $id = 12345;
    $result = $client->order->update($id, [
        'order_details' => [
            'status' => [
                'code' => 'fulfilled',
                'message' => 'Fulfilled'
            ],
            'tags' => [
                'october_campaign'
            ]
        ]
    ]);


`Back to top <#top>`_