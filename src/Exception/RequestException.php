<?php

namespace Acelot\JsonRpc\Exception;

use Acelot\JsonRpc\Exception;

/**
 * Class RequestException
 * @package Acelot\JsonRpc\Exception
 */
class RequestException extends \Exception
{
    /**
     * Invalid request error code from JSON-RPC 2.0 standard
     */
    const CODE = -32600;

    /**
     * @param string $message
     */
    public function __construct($message = 'The JSON sent is not a valid Request object')
    {
        \Exception::__construct($message, self::CODE);
    }
}