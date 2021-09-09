<?php

declare(strict_types=1);

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

    public function expired()
    {
        return $this->expired ?? null;
    }

    public function amount()
    {
        return $this->amount ?? null;
    }

    public function customerId()
    {
        return $this->customerId ?? null;
    }

    public function partnerRef()
    {
        return $this->partnerRef ?? null;
    }

    public function customerPhone()
    {
        return $this->customerPhone ?? null;
    }

    public function customerEmail()
    {
        return $this->customerEmail ?? null;
    }

    public function customerName()
    {
        return $this->customerName ?? null;
    }

    public function retailCode()
    {
        return $this->retailCode ?? null;
    }

    public function bankCode()
    {
        return $this->bankCode ?? null;
    }

    public function eWalletPhone()
    {
        return $this->eWalletPhone ?? null;
    }

    public function billTitle()
    {
        return $this->billTitle ?? null;
    }

    public function items()
    {
        return $this->items ?? [];
    }
}
