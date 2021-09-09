<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure;
use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends Base
{
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
     * Instance kelas Administration.
     * Untuk mendapatkan data bank aktif beserta kode bank.
     *
     * @param Closure|null $closure
     *
     * @return Administration
     */
    public function administration(Closure $closure = null)
    {
        $admin = new Administration($this);

        if ($closure !== null) {
            $closure($admin);
        }

        return $admin;
    }

    /**
     * Instance kelas Transaction.
     * Untuk menjalankan transaksi pembayaran serta refund.
     *
     * @param Closure|null $closure
     *
     * @return Transaction
     */
    public function transaction(Closure $closure = null)
    {
        $transaction = new Transaction($this);

        if ($closure !== null) {
            $closure($transaction);
        }

        return $transaction;
    }

    /**
     * Instance kelas Transfer.
     * Untuk menjalankan transaksi transfer bank.
     *
     * @param Closure|null $closure
     *
     * @return Transfer
     */
    public function transfer(Closure $closure = null)
    {
        $transfer = new Transfer($this);

        if ($closure !== null) {
            $closure($transfer);
        }

        return $transfer;
    }

    /**
     * Instance kelas Report.
     * Untuk pengecekan transaksi pembayaran setelah pembayaran.
     *
     * @param Closure|null $closure
     *
     * @return Transaction
     */
    public function report(Closure $closure = null)
    {
        $report = new Report($this);

        if ($closure !== null) {
            $closure($report);
        }

        return $report;
    }

    /**
     * Tambahkan debug message.
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
     * Tambahkan error message.
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
     * Cek jika ada error
     *
     * @return boolean
     */
    public function hasError()
    {
        return count($this->errors) > 0;
    }

    /**
     * Reset error messages
     *
     */
    public function resetError()
    {
        $this->errors = [];
        return $this;
    }

    /**
     * Reset debug messages
     *
     */
    public function resetDebug()
    {
        $this->errors = [];
        return $this;
    }

    /**
     * Jalankan POST request.
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

            $this->addDebug('URL: '.$this->connector->getConfig('base_uri').'/'.$endpoint);
            $this->addDebug('Request Method: POST');
            $this->addDebug('Request Params: '.json_encode($params));
            $this->addDebug('Request Headers: '.json_encode(array_merge($this->connector->getConfig('headers'), $headers)));

            $response = $this->connector->post(ltrim($endpoint, '/'), [
                'json' => $params,
                'headers' => $headers
            ]);

            $body = $response->getBody()->getContents();

            $this->addDebug('Response HTTP Code: '.$response->getStatusCode());
            $this->addDebug('Response Header: '.json_encode($response->getHeaders()));
            $this->addDebug('Response Body: '.$body);

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
     * Jalankan GET request.
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

            $this->addDebug('URL: '.$this->connector->getConfig('base_uri').'/'.$endpoint);
            $this->addDebug('Request Method: GET');
            $this->addDebug('Request Params: '.json_encode($params));
            $this->addDebug('Request Headers: '.json_encode(array_merge($this->connector->getConfig('headers'), $headers)));

            $response = $this->connector->get(ltrim($endpoint, '/').'?'.http_build_query($params), [
                'headers' => $headers
            ]);

            $body = $response->getBody()->getContents();

            $this->addDebug('Response HTTP Code: '.$response->getStatusCode());
            $this->addDebug('Response Header: '.json_encode($response->getHeaders()));
            $this->addDebug('Response Body: '.$body);

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
