<?php

namespace Onetoweb\Sendcloud\Config;

enum Method: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
}
