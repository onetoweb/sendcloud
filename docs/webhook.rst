.. _top:
.. title:: Webhook

`Back to index <index.rst>`_

=======
Webhook
=======

.. contents::
    :local:


Verify webhook & get webhook data
`````````````````````````````````

.. code-block:: php
    
    use Symfony\Component\HttpFoundation\Response;
    
    // verify webhook data
    if ($client->webhook->verify()) {
        
        // get webhook data
        $data = $client->webhook->data();
        
        // send ok response
        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->send();
        
    } else {
        
        // send bad request response
        $response = new Response();
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $response->send();
    }


`Back to top <#top>`_