.. _top:
.. title:: Parcel

`Back to index <index.rst>`_

======
Parcel
======

.. contents::
    :local:


Get parcel document
```````````````````

.. code-block:: php
    
    $parcelId = 12345;
    $type = 'label'; // possible values: label, customs-declaration or air-waybill
    $format = 'pdf'; // possible values: pdf or zpl
    $dpi = 72; // possible values: 72, 150, 203, 300 or 600
    $paperSize = 'A4'; // possible values: A4, A5 & A6
    $result = $client->parcel->getDocument($parcelId, $type, $format, $dpi, $paperSize);
    
    // store file
    $filename = 'path/to/filename.pdf';
    \Onetoweb\Sendcloud\Utils::storeFile($filename, $result);


Get multiple parcel documents
`````````````````````````````

.. code-block:: php
    
    $parcels = [1234, 5678];
    $type = 'label'; // possible values: label, customs-declaration or air-waybill
    $format = 'pdf'; // possible values: pdf or zpl
    $paperSize = 'A4'; // possible values: A4, A5 & A6
    $result = $client->parcel->getDocuments($parcels, $type, $format, $paperSize);
    
    // store file
    $filename = 'path/to/filename.pdf';
    \Onetoweb\Sendcloud\Utils::storeFile($filename, $result);


Get parcel statuses
```````````````````

.. code-block:: php
    
    $result = $client->parcel->statuses();


`Back to top <#top>`_