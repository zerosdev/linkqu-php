<?php declare(strict_types=1);

namespace ZerosDev\LinkQu\Traits;

use ZerosDev\LinkQu\Constant;

trait Setter
{
    public function setMode($mode = Constant::DEVELOPMENT)
    {
        $this->mode = $mode;
        return $this;
    }

    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }

    public function setDebug(bool $debug)
    {
        $this->debug = $debug;
        return $this;
    }
}
