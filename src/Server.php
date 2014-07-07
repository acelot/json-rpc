<?php

namespace Acelot\JsonRpc;

use Acelot\JsonRpc\Exception\ParseException;
use Acelot\JsonRpc\Exception\RequestException;
use Acelot\JsonRpc\Response\Error;
use Acelot\JsonRpc\Response\Result;
use Acelot\JsonRpc\Transport\PhpInput;

/**
 * Class Server
 * @package Acelot\JsonRpc
 */
class Server
{
    const PROTOCOL_VERSION = '2.0';
    const ERROR_INTERNAL = -32603;
    const ERROR_METHOD = -32601;
    const ERROR_PARAMS = -32602;

    /**
     * @var object
     */
    protected $service;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param object $class
     * @param TransportInterface $transport
     */
    public function __construct($service, TransportInterface $transport = null)
    {
        if (!is_object($service)) {
            throw new \InvalidArgumentException('Service must be an object');
        }

        $this->service = $service;

        if (!$transport) {
            $this->setTransport(new PhpInput());
        }
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function dispatch()
    {
        try {
            $data = $this->parse($this->transport->read());

            if ($this->isBatch($data)) {
                $response = $this->executeBatch($data);
            } else {
                $response = $this->executeRequest(Request::factory($data));
            }
        } catch (ParseException $e) {
            $response = (new Error($e->getCode(), $e->getMessage()))->getResponse();
        } catch (RequestException $e) {
            $response = (new Error($e->getCode(), $e->getMessage()))->getResponse();
        }

        $this->transport->write(json_encode($response, JSON_UNESCAPED_UNICODE));
    }

    protected function parse($raw)
    {
        $data = json_decode($raw, true);

        if (!$data) {
            throw new ParseException();
        }

        return $data;
    }

    /**
     * @param $data array
     * @return bool
     */
    protected function isBatch($data)
    {
        return !isset($data['jsonrpc']);
    }

    /**
     * @param array $batch
     * @return array
     */
    protected function executeBatch(array $batch)
    {
        $response = array();

        foreach ($batch as $data) {
            try {
                $request = Request::factory($data);
                $response[] = $this->executeRequest($request);
            } catch (RequestException $e) {
                $response[] = (new Error($e->getCode(), $e->getMessage()))->getResponse();
            }
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return Result
     */
    protected function executeRequest(Request $request)
    {
        $method = $request->getMethod();

        try {
            if (method_exists($this->service, $method)) {
                $result = call_user_func_array(array($this->service, $method), $request->getParams());

                $response = new Result($result, $request->getId());
            } else {
                throw new \BadMethodCallException("Method \"{$method}\" not found");
            }
        } catch (\BadMethodCallException $e) {
            $response = new Error(self::ERROR_METHOD, $e->getMessage(), null, $request->getId());
        } catch (\InvalidArgumentException $e) {
            $response = new Error(self::ERROR_INTERNAL, $e->getMessage(), null, $request->getId());
        } catch (\Exception $e) {
            $response = new Error(self::ERROR_INTERNAL, $e->getMessage(), null, $request->getId());
        }

        return $response->getResponse();
    }
} 