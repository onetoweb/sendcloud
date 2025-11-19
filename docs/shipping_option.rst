.. _top:
.. title:: Shipping Option

`Back to index <index.rst>`_

===============
Shipping Option
===============

.. contents::
    :local:


Return a list of available shipping options
```````````````````````````````````````````

.. code-block:: php
    
    $result = $client->shippingOption->list([
        'from_country_code' => 'NL',
        'to_country_code' => 'NL',
        'from_postal_code' => '1012AB',
        'to_postal_code' => '2000AB',
        'parcels' => [
            [
                'dimensions' => [
                    'length' => 30,
                    'width' => 20,
                    'height' => 15,
                    'unit' => 'cm'
                ],
                'weight' => [
                    'value' => 2,
                    'unit' => 'kg'
                ],
                'additional_insured_price' => 50,
            ], [
                'dimensions' => [
                    'length' => 25,
                    'width' => 18,
                    'height' => 12,
                    'unit' => 'cm'
                ],
                'weight' => [
                    'value' => 1.5,
                    'unit' => 'kg'
                ],
                'total_insured_price' => 100,
            ]
        ],
        'carrier_code' => 'postnl',
        'functionalities' => [
            'signature' => true
        ],
        'calculate_quotes' => true
    ]);


Create a list of shipping options
`````````````````````````````````

.. code-block:: php
    
    $result = $client->shippingOption->create([
        'from_country_code' => 'NL',
        'to_country_code' => 'NL',
        'weight' => [
            'value' => '2',
            'unit' => 'kg'
        ],
        'carrier_code' => 'postnl',
        'functionalities' => [
            'signature' => true
        ]
    ]);


`Back to top <#top>`_