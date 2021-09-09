<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use ZerosDev\LinkQu\Traits\Setter;
use ZerosDev\LinkQu\Traits\Getter;

class Base
{
    use Setter;
    use Getter;

    /**
     * Guzzle HTTP connection
     */
    protected $connector;

    /**
     * API mode
     */
    protected $mode;

    /**
     * API client id
     */
    protected $clientId;

    /**
     * API client secret
     */
    protected $clientSecret;

    /**
     * API username
     */
    protected $username;

    /**
     * API PIN
     */
    protected $pin;

    /**
     * Enable/disable debug
     */
    protected $debug = false;

    /**
     * Debug messages
     */
    protected $debugs = [];

    /**
     * Error messages
     */
    protected $errors = [];
}
