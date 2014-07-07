<?php

namespace Acelot\JsonRpc;

use Acelot\JsonRpc\Exception\RequestException;

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
     * @var string|int|null
     */
    protected $id;

    /**
     * @param $method
     * @param array $params
     * @param null $id
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
     * @param string|int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string|int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getJson()
    {
        return array(
            'jsonrpc' => self::PROTOCOL_VERSION,
            'method'  => $this->getMethod(),
            'params'  => $this->getParams(),
            'id'      => $this->getId()
        );
    }
}