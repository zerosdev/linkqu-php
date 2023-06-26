<?php

namespace ZerosDev\LinkQu;

use ZerosDev\LinkQu\Base;
use ZerosDev\LinkQu\Client;

class Signature extends Base
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Condstructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // create signature
    public function create(string $path, string $method, string $secondValue)
    {
        $signToString = $path.$method.$secondValue;
        $signatre = hash_hmac('sha256', $signToString, $this->client->serverKey());
        return $signatre;
    }
}
