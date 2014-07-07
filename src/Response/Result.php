<?php

namespace Acelot\JsonRpc\Response;

use Acelot\JsonRpc\ResponseAbstract;
use Acelot\JsonRpc\ResponseInterface;

/**
 * Class Result
 * @package Acelot\JsonRpc\Response
 */
class Result extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var mixed
     */
    protected $result;

    /**
     * @param mixed      $result Request result
     * @param int|string $id     Request ID
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