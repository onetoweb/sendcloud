.. _top:
.. title:: Integration

`Back to index <index.rst>`_

===========
Integration
===========

.. contents::
    :local:


List all integrations
`````````````````````

.. code-block:: php
    
    $result = $client->integration->list([
        
        // optional parameters
        'sort' => 'created_at', // possible values: integration_type, created_at, updated_at, last_fetch, or failing_since
    ]);


Retrieve an integration
```````````````````````

.. code-block:: php
    
    $integrationId = 12345;
    $result = $client->integration->get($integrationId);


Update certain parts of an integration
``````````````````````````````````````

.. code-block:: php
    
    $integrationId = 12345;
    $result = $client->integration->update($integrationId, [
        'shop_name' => 'My Webshop'
    ]);


Delete an integration
`````````````````````

.. code-block:: php
    
    $integrationId = 12345;
    $result = $client->integration->delete($integrationId);


Retrieve available shop order statuses for a given integration
``````````````````````````````````````````````````````````````

.. code-block:: php
    
    $integrationId = 12345;
    $result = $client->integration->getOrderStatuses($integrationId);


Create or overwrite the whole list of available shop order statuses
```````````````````````````````````````````````````````````````````

.. code-block:: php
    
    $result = $client->integration->createOrderStatus([
        'integration_id' => 23452345,
        'statuses' => [
            [
                'external_id' => 'Send-4',
                'translations' => [
                    [
                        'status' => 'Sent',
                        'language' => 'en-gb'
                    ], [
                        'status' => 'Verzonden',
                        'language' => 'nl-nl'
                    ]
                ]
            ], [
                'external_id' => '15',
                'translations' => [
                    [
                        'status' => 'Delivered',
                        'language' => 'en-gb'
                    ], [
                        'status' => 'Bezorgt',
                        'language' => 'nl-nl'
                    ]
                ]
            ]
        ]
    ]);


Retrieve custom status mapping for an integration
`````````````````````````````````````````````````

.. code-block:: php
    
    $integrationId = 12345;
    $result = $client->integration->getOrderStatusesMapping($integrationId);


Create or update custom status mapping for an integration
`````````````````````````````````````````````````````````

.. code-block:: php
    
    $result = $client->integration->updateOrderStatusesMapping([
        'integration_id' => 23452345,
        'mapping' => [
            [
                'status_category' => 'READY_TO_SEND',
                'external_id' => '11'
            ], [
                'status_category' => 'IN_TRANSIT',
                'external_id' => '11'
            ], [
                'status_category' => 'DELIVERED',
                'external_id' => '12'
            ]
        ]
    ]);


`Back to top <#top>`_