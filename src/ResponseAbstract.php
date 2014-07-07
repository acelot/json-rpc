<?php

namespace Acelot\JsonRpc;

abstract class ResponseAbstract implements ResponseInterface
{
    /**
     * @var string|int
     */
    protected $id;

    /**
     * @param int|string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    public function getResponse()
    {
        return array_merge(array(
            'jsonrpc' => Server::PROTOCOL_VERSION,
            'id'      => $this->getId()
        ), $this->getResponseData());
    }
} 