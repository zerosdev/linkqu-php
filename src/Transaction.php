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
     * @var ZerosDev\LinkQu\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param ZerosDev\LinkQu\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Create Permata Virtual Account
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createVaPermata(Closure $closure)
    {
        $closure($this);

        $params = [
            'expired'           => $this->expired(),
            'amount'            => $this->amount(),
            'customer_id'       => $this->customerId(),
            'partner_reff'      => $this->partnerRef(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'customer_name'     => $this->customerName(),
            'bank_code'         => '013',
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin()
        ];

        return $this->client->post('linkqu-partner/transaction/create/vapermata', $params);
    }

    /**
     * Create Other Bank Virtual Account
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createVa(Closure $closure)
    {
        $closure($this);

        $params = [
            'expired'           => $this->expired(),
            'amount'            => $this->amount(),
            'customer_id'       => $this->customerId(),
            'partner_reff'      => $this->partnerRef(),
            'customer_name'    => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'bank_code'         => $this->bankCode(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin()
        ];

        return $this->client->post('linkqu-partner/transaction/create/va', $params);
    }

    /**
     * Create Dedicated (Open Amount) Virtual Account
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createDedicatedVa(Closure $closure)
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

        return $this->client->post('linkqu-partner/transaction/create/vadedicated/add', $params);
    }

    /**
     * Update Dedicated (Open Amount) Virtual Account
     *
     * @param  Closure $closure
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
     * Create Retail
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createRetail(Closure $closure)
    {
        $closure($this);

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
            'pin'               => $this->client->pin()
        ];

        return $this->client->post('linkqu-partner/transaction/create/retail', $params);
    }

    /**
     * Create QRIS
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createQris(Closure $closure)
    {
        $closure($this);

        $params = [
            'customer_id'       => $this->customerId(),
            'customer_name'     => $this->customerName(),
            'customer_phone'    => $this->customerPhone(),
            'customer_email'    => $this->customerEmail(),
            'amount'            => $this->amount(),
            'partner_reff'      => $this->partnerRef(),
            'expired'           => $this->expired(),
            'username'          => $this->client->username(),
            'pin'               => $this->client->pin()
        ];

        return $this->client->post('linkqu-partner/transaction/create/qris', $params);
    }

    /**
     * Create OVO Push
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createOvoPush(Closure $closure)
    {
        $closure($this);

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
        ];

        foreach ($this->items() as $i => $item) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/ovopush', $params);
    }

    /**
     * Create E-Wallet Payment
     *
     * @param  Closure $closure
     *
     * @return \stdClass|false
     */
    public function createPaymentEwallet(Closure $closure)
    {
        $closure($this);

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
        ];

        foreach ($this->items() as $i => $item) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/paymentewallet', $params);
    }
}
