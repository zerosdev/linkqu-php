<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use ZerosDev\LinkQu\Traits\Setter;
use ZerosDev\LinkQu\Traits\Getter;

class Base
{
    use Setter;
    use Getter;

    protected $connector;
    protected $mode;

    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $pin;

    protected $debug = false;

    protected $debugs = [];
    protected $errors = [];
}
