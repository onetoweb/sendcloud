.. _top:
.. title:: Sender Address

`Back to index <index.rst>`_

==============
Sender Address
==============

.. contents::
    :local:


Retrieve a list of sender addresses
```````````````````````````````````

.. code-block:: php
    
    $result = $client->senderAddress->list();


Retrieve a list of sender addresses (pagination)
````````````````````````````````````````````````

.. code-block:: php
    
    $limit = 100;
    $offset = 0;
    $reverse = false;
    $result = $client->senderAddress->list($limit, $offset, $reverse);


Retrieve a sender address
`````````````````````````

.. code-block:: php
    
    $addressId = 12345;
    $result = $client->senderAddress->get($addressId);


`Back to top <#top>`_