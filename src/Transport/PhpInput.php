<?php

namespace Acelot\JsonRpc\Transport;

use Acelot\JsonRpc\TransportInterface;

/**
 * Class PhpInput
 * @package Acelot\JsonRpc\Transport
 */
class PhpInput implements TransportInterface
{
    public function read()
    {
        return file_get_contents('php://input');
    }

    public function write($data)
    {
        echo $data;
    }
}