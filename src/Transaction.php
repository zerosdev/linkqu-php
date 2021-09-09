<?php declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure, Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Transaction extends Base
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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

        foreach( $this->items() as $i => $item ) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/ovopush', $params);
    }

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

        foreach( $this->items() as $i => $item ) {
            $params['item_name'][$i] = $item['name'];
            $params['item_price'][$i] = $item['price'];
            $params['item_image_url'][$i] = $item['image'];
        }

        return $this->client->post('linkqu-partner/transaction/create/paymentewallet', $params);
    }
}
