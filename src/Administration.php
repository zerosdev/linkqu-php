<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Administration
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get data bank.
     *
     * @return \stdClass|false
     */
    public function banks()
    {
        $endpoint = 'linkqu-partner/masterbank/list';
        $params = [];

        return $this->client->get($endpoint, $params);
    }

    /**
     * Get data emoney
     *
     * @return \stdClass|false
     */
    public function emoney()
    {
        $endpoint = 'linkqu-partner/data/emoney';
        $params = [
            'username' => $this->client->username()
        ];

        return $this->client->get($endpoint, $params);
    }

    /**
     * Get data resume account.
     *
     * @return \stdClass|false
     */
    public function resumeAccount()
    {
        $endpoint = 'linkqu-partner/akun/resume';
        $params = [
            'username' => $this->client->username()
        ];

        return $this->client->get($endpoint, $params);
    }
}
