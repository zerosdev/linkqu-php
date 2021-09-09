<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Traits;

use DateTime;
use DateTimeZone;
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

    public function setExpired(int $minute, $format = 'YmdHis')
    {
        $dt = new DateTime();
        $this->expired = $dt->setTimestamp(time() + ($minute*60))
            ->setTimezone(new DateTimeZone('Asia/Jakarta'))
            ->format($format);

        return $this;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function setPartnerRef($partnerRef)
    {
        $this->partnerRef = $partnerRef;
        return $this;
    }

    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
        return $this;
    }

    public function setRetailCode($retailCode)
    {
        $this->retailCode = $retailCode;
        return $this;
    }

    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
        return $this;
    }

    public function setEwalletPhone($eWalletPhone)
    {
        $this->eWalletPhone = $eWalletPhone;
        return $this;
    }

    public function setBillTitle($billTitle)
    {
        $this->billTitle = $billTitle;
        return $this;
    }

    public function setItem($name, $price, $image)
    {
        $this->items[] = [
            'name'  => $name,
            'price' => $price,
            'image' => $image
        ];

        return $this;
    }
}
