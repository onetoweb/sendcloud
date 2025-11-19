.. _top:
.. title:: Pickup

`Back to index <index.rst>`_

======
Pickup
======

.. contents::
    :local:


Retrieve a list of pickups
``````````````````````````

.. code-block:: php
    
    $result = $client->pickup->list();


Retrieve a pickup
`````````````````

.. code-block:: php
    
    $pickupId = 12345;
    $result = $client->pickup->get($pickupId);


Create a pickup
```````````````

.. code-block:: php
    
    $result = $client->pickup->create([
        'address' => [
            'name' => 'John Doe',
            'company_name' => 'Sendcloud',
            'country_code' => 'NL',
            'city' => 'Eindhoven',
            'email' => 'example@sendcloud.com',
            'address_line_1' => 'Stadhuisplein',
            'house_number' => '10',
            'address_line_2' => '',
            'postal_code' => '5611 EM',
            'phone_number' => '+310612345678'
        ],
        'time_slots' => [
            [
                'start_at' => (new \DateTime())->modify('+5 days')->format(\DateTimeInterface::ATOM),
                'end_at' => (new \DateTime())->modify('+5 days +3 hour')->format(\DateTimeInterface::ATOM),
            ]
        ],
        'items' => [
            [
                'quantity' => 20,
                'container_type' => 'parcel',
                'total_weight' => [
                    'value' => '1.00',
                    'unit' => 'kg'
                ]
            ]
        ],
        'carrier_code' => 'dhl_express'
    ]);


`Back to top <#top>`_