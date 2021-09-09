<?php declare(strict_types=1);

namespace ZerosDev\LinkQu\Traits;

trait Getter
{
    public function connector()
    {
        return $this->connector;
    }
    
    public function mode()
    {
        return $this->mode;
    }

    public function clientId()
    {
        return $this->clientId;
    }

    public function clientSecret()
    {
        return $this->clientSecret;
    }

    public function username()
    {
        return $this->username;
    }

    public function pin()
    {
        return $this->pin;
    }

    public function debug()
    {
        return $this->debug;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function debugs()
    {
        return $this->debugs;
    }
}
