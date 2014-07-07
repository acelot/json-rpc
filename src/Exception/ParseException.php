<?php

namespace Acelot\JsonRpc\Exception;

use Acelot\JsonRpc\Exception;

class ParseException extends \Exception
{
    const CODE = -32700;

    public function __construct($message = 'Invalid JSON')
    {
        \Exception::__construct($message, self::CODE);
    }
}