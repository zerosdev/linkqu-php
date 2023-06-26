<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure;
use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Transaction extends Base
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;
    protected $signature;
    /**
     * Condstructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->signature = new Signature($client);
    }

    /**
     * Create Virtual Account for Permata bank.
     * This service will returned Virtual Account Number to be paid one time only.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function createVaPermata(Closure $closure)
    {
        $closure($this);
        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/vapermata';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired()  . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->client->clientId()));
        $params = [
            'expired'           => $this->expired(),
            'amount'            => $this->amount(),
            'customer_id'       => $this->customerId(),
            'partner_reff'      => $this->partnerRef(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'customer_name'     => $this->customerName(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        return $this->client->post('linkqu-partner/transaction/create/vapermata', $params);
    }

    /**
     * Create Virtual Account for others banks.
     * This service will returned Virtual Account Number to be paid one time only.
     *
     * @param Closure $closure
     *
     * @return \stdClass|flase
     */
    public function createVa(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/va';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired() . $this->bankCode() . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->client->clientId()));
        $params = [
            'expired'           => $this->expired(),
            'amount'            => $this->amount(),
            'customer_id'       => $this->customerId(),
            'partner_reff'      => $this->partnerRef(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'bank_code'         => $this->bankCode(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        return $this->client->post('linkqu-partner/transaction/create/va', $params);
    }

    /**
     * Create Dedicated Virtual Account.
     * Create Bank Virtual Account that never expires and free amount.
     *
     * @param Closure $closure
     *
     * @return \stdClass|flase
     */
    public function createDedicatedVa(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/vadedicated/add';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->bankCode() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->client->clientId()));

        $params = [
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'bank_code'         => $this->bankCode(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        return $this->client->post('linkqu-partner/transaction/create/vadedicated/add', $params);
    }

    /**
     * Update Dedicated Virtual Account.
     * For updating virtual account data such as email, name, and phone.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function updateDedicatedVa(Closure $closure)
    {
        $closure($this);

        $params = [
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'bank_code'         => $this->bankCode(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin()
        ];

        return $this->client->post('linkqu-partner/transaction/create/vadedicated/update', $params);
    }
    /**
     * For receiving funds from Retail Market.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function createRetail(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/retail';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired() . $this->retailCode() . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->client->clientId()));

        $params = [
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'retail_code'       => $this->retailCode(),
            'amount'            => $this->amount(),
            'partner_reff'      => $this->partnerRef(),
            'expired'           => $this->expired(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        return $this->client->post('linkqu-partner/transaction/create/retail', $params);
    }

    /**
     * For receiving funds from QRIS (QR Code)
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function createQris(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/qris';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired() . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->client->clientId()));

        $params = [
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'amount'            => $this->amount(),
            'partner_reff'      => $this->partnerRef(),
            'expired'           => $this->expired(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        return $this->client->post('linkqu-partner/transaction/create/qris', $params);
    }

    /**
     * OVO Create Payment - Push to OVO App.
     * For receiving funds from Ewallet Apps.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function createOvoPush(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/ovopush';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired() . "PAYOVO" . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->eWalletPhone() . $this->client->clientId()));

        $params = [
            'amount'            => $this->amount(),
            'partner_reff'      => $this->partnerRef(),
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'expired'           => $this->expired(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'retail_code'       => 'PAYOVO',
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'ewallet_phone'     => $this->eWalletPhone(),
            'bill_title'        => $this->billTitle(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        foreach ($this->items() as $i => $item) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/ovopush', $params);
    }

    /**
     * For receiving funds from Ewallet Apps.
     * This will return a payment url.
     * Partner should open the url to pay their order.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function createPaymentEwallet(Closure $closure)
    {
        $closure($this);

        // create signature
        $regex = '/[^0-9a-zA-Z]/';
        // path for signature
        $path = '/transaction/create/paymentewallet';
        // secondvalue
        $secondValue = strtolower(preg_replace($regex, "", $this->amount() . $this->expired() . $this->retailCode() . $this->partnerRef() . $this->customerId() . $this->customerName() . $this->customerEmail() . $this->eWalletPhone() . $this->client->clientId()));

        $params = [
            'amount'            => $this->amount(),
            'partner_reff'      => $this->partnerRef(),
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'expired'           => $this->expired(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin(),
            'retail_code'       => $this->retailCode(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'ewallet_phone'     => $this->eWalletPhone(),
            'bill_title'        => $this->billTitle(),
            'signature'         => $this->signature->create($path, 'POST', $secondValue)
        ];

        foreach ($this->items() as $i => $item) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/paymentewallet', $params);
    }
}
