<?php

namespace Acelot\JsonRpc\Response;

use Acelot\JsonRpc\ResponseAbstract;
use Acelot\JsonRpc\ResponseInterface;

/**
 * Class Error
 * @package Acelot\JsonRpc\Response
 */
class Error extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @param int        $code    A Number that indicates the error type that occurred
     * @param string     $message A String providing a short description of the error
     * @param mixed      $data    A Primitive or Structured value that contains additional information about the error
     * @param int|string $id      Request ID
     */
    public function __construct($code, $message = null, $data = null, $id = null)
    {
        $this->setCode($code);
        $this->setMessage($message);
        $this->setData($data);
        $this->setId($id);
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    function getResponseData()
    {
        return array(
            'error'   => array(
                'code'    => $this->getCode(),
                'message' => $this->getMessage(),
                'data'    => $this->getData()
            )
        );
    }
}