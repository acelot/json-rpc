<?php

namespace Acelot\JsonRpc;

/**
 * Interface TransportInterface
 * @package Acelot\JsonRpc
 */
interface TransportInterface
{
    /**
     * @return mixed
     */
    public function read();

    /**
     * @param $data
     * @return mixed
     */
    public function write($data);
} 