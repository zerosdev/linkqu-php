<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure;
use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends Base
{
    protected $administrationInstance;
    protected $transactionInstance;
    protected $transferInstance;
    protected $reportInstance;

    /**
     * Constructor.
     *
     * @param Closure $closure
     */
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

    /**
     * Create new Administration instance.
     * Use this to retrieve activated banks and their codes.
     *
     * @param Closure|null $closure
     *
     * @return Administration
     */
    public function administration(Closure $closure = null)
    {
        $this->administrationInstance = ($this->administrationInstance === null)
            ? new Administration($this)
            : $this->administrationInstance;

        if ($closure !== null) {
            $closure($this->administrationInstance);
        }

        return $this->administrationInstance;
    }

    /**
     * Create new Transaction instance.
     * Use this to process the transaction and/or refund.
     *
     * @param Closure|null $closure
     *
     * @return Transaction
     */
    public function transaction(Closure $closure = null)
    {
        $this->transactionInstance = ($this->transactionInstance === null)
            ? new Transaction($this)
            : $this->transactionInstance;

        if ($closure !== null) {
            $closure($this->transactionInstance);
        }

        return $this->transactionInstance;
    }

    /**
     * Create new Transfer instance.
     * Use this to process the bank transfer.
     *
     * @param Closure|null $closure
     *
     * @return Transfer
     */
    public function transfer(Closure $closure = null)
    {
        $this->transferInstance = ($this->transferInstance === null)
            ? new Transfer($this)
            : $this->transferInstance;

        if ($closure !== null) {
            $closure($this->transferInstance);
        }

        return $this->transferInstance;
    }

    /**
     * Create new Report instance.
     * Use this to check the payment transaction details.
     *
     * @param Closure|null $closure
     *
     * @return Transaction
     */
    public function report(Closure $closure = null)
    {
        $this->reportInstance = ($this->reportInstance === null)
            ? new Report($this)
            : $this->reportInstance;

        if ($closure !== null) {
            $closure($this->reportInstance);
        }

        return $this->reportInstance;
    }

    /**
     * Add debug message.
     *
     * @param string $message
     */
    public function addDebug(string $message)
    {
        if ($this->debug) {
            $this->debugs[] = $message;
        }

        return $this;
    }

    /**
     * Add error message.
     *
     * @param string $message
     * @param bool   $safeToClient
     */
    public function addError(string $message, bool $safeToClient = false)
    {
        $this->errors[] = [
            'message' => $message,
            'safe_to_client' => $safeToClient
        ];

        return $this;
    }

    /**
     * Is there any error?
     *
     * @return bool
     */
    public function hasError()
    {
        return count($this->errors) > 0;
    }

    /**
     * Reset error messages.
     */
    public function resetError()
    {
        $this->errors = [];
        return $this;
    }

    /**
     * Reset debug messages.
     */
    public function resetDebug()
    {
        $this->debugs = [];
        return $this;
    }

    /**
     * Run a POST request.
     *
     * @param string $endpoint
     * @param array  $params
     * @param array  $headers
     *
     * @return \stdClass|false
     */
    public function post(string $endpoint, array $params = [], array $headers = [])
    {
        try {
            $this->resetError();
            $this->resetDebug();

            $this->addDebug('URL: ' . $this->connector->getConfig('base_uri') . '/' . $endpoint);
            $this->addDebug('Request Method: POST');
            $this->addDebug('Request Params: ' . json_encode($params));
            $this->addDebug('Request Headers: ' . json_encode(array_merge($this->connector->getConfig('headers'), $headers)));

            $response = $this->connector->post(ltrim($endpoint, '/'), [
                'json' => $params,
                'headers' => $headers
            ]);

            $body = $response->getBody()->getContents();

            $this->addDebug('Response HTTP Code: ' . $response->getStatusCode());
            $this->addDebug('Response Header: ' . json_encode($response->getHeaders()));
            $this->addDebug('Response Body: ' . $body);

            $data = json_decode($body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response");
            }

            return $data;
        } catch (Exception $e) {
            $this->addError($e->getMessage(), ($e instanceof SendableException));
            return false;
        }
    }

    /**
     * Run a GET request.
     *
     * @param string $endpoint
     * @param array  $params
     * @param array  $headers
     *
     * @return \stdClass|false
     */
    public function get($endpoint, array $params = [], array $headers = [])
    {
        try {
            $this->resetError();
            $this->resetDebug();

            $this->addDebug('URL: ' . $this->connector->getConfig('base_uri') . '/' . $endpoint);
            $this->addDebug('Request Method: GET');
            $this->addDebug('Request Params: ' . json_encode($params));
            $this->addDebug('Request Headers: ' . json_encode(array_merge($this->connector->getConfig('headers'), $headers)));

            $response = $this->connector->get(ltrim($endpoint, '/') . '?' . http_build_query($params), [
                'headers' => $headers
            ]);

            $body = $response->getBody()->getContents();

            $this->addDebug('Response HTTP Code: ' . $response->getStatusCode());
            $this->addDebug('Response Header: ' . json_encode($response->getHeaders()));
            $this->addDebug('Response Body: ' . $body);

            $data = json_decode($body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response");
            }

            return $data;
        } catch (Exception $e) {
            $this->addError($e->getMessage(), ($e instanceof SendableException));
            return false;
        }
    }
}
