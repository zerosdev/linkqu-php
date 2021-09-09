<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Traits;

use ZerosDev\LinkQu\Constant;

trait Getter
{
    public function connector()
    {
        return $this->connector ?? null;
    }

    public function mode()
    {
        return $this->mode ?? Constant::DEVELOPMENT;
    }

    public function clientId()
    {
        return $this->clientId ?? null;
    }

    public function clientSecret()
    {
        return $this->clientSecret ?? null;
    }

    public function username()
    {
        return $this->username ?? null;
    }

    public function pin()
    {
        return $this->pin ?? null;
    }

    public function debug()
    {
        return $this->debug ?? false;
    }

    public function errors()
    {
        return $this->errors ?? [];
    }

    public function debugs()
    {
        return $this->debugs ?? [];
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

    public function accountNumber()
    {
        return $this->accountNumber ?? null;
    }

    public function inquiryRef()
    {
        return $this->inquiryRef;
    }
}
