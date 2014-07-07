<?php

namespace Acelot\JsonRpc\Exception;

use Acelot\JsonRpc\Exception;

class RequestException extends \Exception
{
    const CODE = -32600;

    public function __construct($message = 'The JSON sent is not a valid Request object')
    {
        \Exception::__construct($message, self::CODE);
    }
}