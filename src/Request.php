<?php

namespace Acelot\JsonRpc;

use Acelot\JsonRpc\Exception\RequestException;

/**
 * Class Request
 * @package Acelot\JsonRpc
 */
class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var int|string
     */
    protected $id;

    /**
     * @param string     $method A String containing the name of the method to be invoked
     * @param array      $params A Structured value that holds the parameter values to be used during the invocation of the method
     * @param int|string $id     Request ID
     */
    public function __construct($method = null, $params = array(), $id = null)
    {
        $this->setMethod($method);
        $this->setParams($params);
        $this->setId($id);
    }

    /**
     * @param array $data
     * @return Request
     * @throws Exception\RequestException
     */
    public static function factory(array $data)
    {
        $requiredFields = array('jsonrpc', 'method', 'params', 'id');
        $foundFields = array_intersect(array_keys($data), $requiredFields);

        if (count($foundFields) === count($requiredFields) && $data['jsonrpc'] == Server::PROTOCOL_VERSION) {
            return new self($data['method'], $data['params'], $data['id']);
        } else {
            throw new RequestException();
        }
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

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
}