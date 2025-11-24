.. _top:
.. title:: OrderLabel

`Back to index <index.rst>`_

==========
OrderLabel
==========

.. contents::
    :local:


Request a label for given orders asynchronously
```````````````````````````````````````````````

.. code-block:: php
    
    $orderId = 12345;
    $result = $client->orderLabel->getAsync([
        'integration_id' => 12345,
        'orders' => [[
            'order_id' => '1',
            'order_number' => 'ORDER-1',
            'apply_shipping_rules' => false
        ]],
    ]);


Request a label for given order synchronously
`````````````````````````````````````````````

.. code-block:: php
    
    $result = $client->orderLabel->getSync([
        'integration_id' => 12345,
        'order' => [
            'order_id' => '1',
            'order_number' => 'ORDER-1',
            'apply_shipping_rules' => false
        ],
        'label_details' => [
            'mime_type' => 'application/pdf',
            'dpi' => 72
        ]
    ]);


`Back to top <#top>`_