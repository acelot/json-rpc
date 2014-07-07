<?php

namespace Acelot\JsonRpc;

interface TransportInterface
{
    public function read();

    public function write($data);
} 