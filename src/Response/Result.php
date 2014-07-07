<?php

namespace Acelot\JsonRpc\Response;

use Acelot\JsonRpc\ResponseAbstract;
use Acelot\JsonRpc\ResponseInterface;

class Result extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var mixed
     */
    protected $result;

    /**
     * @param mixed $result
     * @param int|string $id
     */
    public function __construct($result, $id = null)
    {
        $this->setResult($result);
        $this->setId($id);
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return array
     */
    function getResponseData()
    {
        return array(
            'data' => $this->getResult()
        );
    }
}