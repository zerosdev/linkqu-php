<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure;
use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends Base
{
    public function __construct(Closure $closure)
    {
        $this->setMode(Constant::DEVELOPMENT);

        $closure($this);

        $this->connector = new GuzzleClient([
            'base_uri'      => (strtolower($this->mode) == Constant::PRODUCTION)
                ? Constant::URL_PRODUCTION
                : Constant::URL_DEVELOPMENT,
            'http_errors'   => false,
            'headers'       => [
                'Accept'        => 'application/json',
                'client-id'     => $this->clientId,
                'client-secret' => $this->clientSecret
            ]
        ]);
    }

    public function administration(Closure $closure = null)
    {
        $admin = new Administration($this);

        if ($closure !== null) {
            $closure($admin);
        }

        return $admin;
    }

    public function transaction(Closure $closure = null)
    {
        $transaction = new Transaction($this);

        if ($closure !== null) {
            $closure($transaction);
        }

        return $transaction;
    }

    public function report(Closure $closure = null)
    {
        $report = new Report($this);

        if ($closure !== null) {
            $closure($report);
        }

        return $report;
    }

    public function addDebug($message)
    {
        if ($this->debug) {
            $this->debugs[] = $message;
        }

        return $this;
    }

    public function addError($message, bool $safe_to_client = false)
    {
        $this->errors[] = [
            'message' => $message,
            'safe_to_client' => $safe_to_client
        ];

        return $this;
    }

    public function post($endpoint, array $params = [], array $headers = [])
    {
        try {
            $response = $this->connector->post(ltrim($endpoint, '/'), [
                'json'          => $params,
                'headers'       => $headers
            ]);
            $body = $response->getBody()->getContents();
            $data = json_decode($body);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->addDebug($body);
                throw new Exception("Invalid JSON response");
            }
            return $data;
        } catch (Exception $e) {
            $this->addError($e->getMessage(), ($e instanceof SendableException));
            return false;
        }
    }

    public function get($endpoint, array $params = [], array $headers = [])
    {
        try {
            $response = $this->connector->get(ltrim($endpoint, '/').'?'.http_build_query($params), [
                'headers' => $headers
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->addDebug($body);
                throw new Exception("Invalid JSON response");
            }

            return $data;
        } catch (Exception $e) {
            $this->addError($e->getMessage(), ($e instanceof SendableException));
            return false;
        }
    }
}
