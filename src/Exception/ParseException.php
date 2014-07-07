<?php

namespace Acelot\JsonRpc\Exception;

use Acelot\JsonRpc\Exception;

/**
 * Class ParseException
 * @package Acelot\JsonRpc\Exception
 */
class ParseException extends \Exception
{
    /**
     * Parse error code from JSON-RPC 2.0 standard
     */
    const CODE = -32700;

    /**
     * @param string $message
     */
    public function __construct($message = 'Invalid JSON')
    {
        \Exception::__construct($message, self::CODE);
    }
}