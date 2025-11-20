.. _top:
.. title:: Contract

`Back to index <index.rst>`_

========
Contract
========

.. contents::
    :local:


Retrieve a list of contracts
````````````````````````````

.. code-block:: php
    
    $result = $client->contract->list();


Retrieve a list of contracts (pagination)
`````````````````````````````````````````

.. code-block:: php
    
    $limit = 100;
    $offset = 0;
    $reverse = false;
    $result = $client->contract->list($limit, $offset, $reverse, [
        
        // optional filters
        'carrier_code' => 'postnl',
        'client_id' => 12345,
        'country_code' => 'NL',
        'is_active' => true,
        'name' => 'name'
    ]);


Create a contract for carrier
`````````````````````````````

.. code-block:: php
    
    $result = $client->contract->create([
        'is_active' => false,
        'is_default_per_carrier' => false,
        'contract_data' => [
            'country' => 'NL',
            'client_id' => 'sendcloud-1'
        ],
        'carrier_code' => 'postnl'
    ]);


Update a contract
`````````````````

.. code-block:: php
    
    $contractId = 12345;
    $result = $client->contract->update($contractId, [
        'is_active' => false,
        'is_default_per_carrier' => false,
        'contract_data' => [
            'country' => 'NL',
            'client_id' => 'sendcloud-1'
        ],
        'carrier_code' => 'postnl'
    ]);


Delete a contract
`````````````````

.. code-block:: php
    
    $contractId = 12345;
    $result = $client->contract->delete($contractId);


Retrieve a list of contracts schemas
````````````````````````````````````

.. code-block:: php
    
    $carrierCode = 'postnl';
    $result = $client->contract->listSchemas($carrierCode);


`Back to top <#top>`_