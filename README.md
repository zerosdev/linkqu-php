# linkqu-php
Unofficial Integration Kit for LinkQu.id

## Requirements
- PHP v7.0.0+
- PHP JSON Extension
- [Guzzle, PHP HTTP Client](https://github.com/guzzle/guzzle) v7.0.0+

## Installation

1. Run command
<pre><code>composer require zerosdev/linkqu-php</code></pre>

2. Run command
<pre><code>composer dump-autoload</code></pre>

### The following steps only needed if you are using Laravel

3. Then
<pre><code>php artisan vendor:publish --provider="ZerosDev\LinkQu\Laravel\ServiceProvider"</code></pre>

4. Edit **config/linkqu.php** and put your API credentials

## Basic Usage

### Laravel Usage

```php
<?php

namespace App\Http\Controllers;

use LinkQu;

class YourController extends Controller
{
    public function index()
    {
        $result = LinkQu::transaction()->createVa(function($va) {
            $va->setAmount(10000)
                ->setExpired(60)
                ->setCustomerId(uniqid())
                ->setPartnerRef(time())
                ->setCustomerName('Nama Pelanggan')
                ->setCustomerPhone('08123456789')
                ->setCustomerEmail('email@customer.com')
                ->setBankCode('014');
        });

        if( LinkQu::hasError() ) {
            print_r(LinkQu::errors());
        } else {
            print_r($result);
        }
    }
}
```

### Non-Laravel Usage

```php
<?php

require 'path/to/your/vendor/autoload.php';

use ZerosDev\LinkQu\Client;
use ZerosDev\LinkQu\Constant;

$linkqu = new Client(function($client) {
    $client->setMode(Constant::DEVELOPMENT)
        ->setClientId('testing')
        ->setClientSecret('123')
        ->setUsername('LI307GXIN')
        ->setPin('2K2NPCBBNNTovgB');
});

$transaction = $linkqu->transaction();

$result = $transaction->createVa(function($va) {
    $va->setAmount(10000)
    ->setExpired(60)
    ->setCustomerId(uniqid())
    ->setPartnerRef(time())
    ->setCustomerName('Nama Pelanggan')
    ->setCustomerPhone('08123456789')
    ->setCustomerEmail('email@customer.com')
    ->setBankCode('014');
});

if( $linkqu->hasError() ) {
    print_r($linkqu->errors());
} else {
    print_r($result);
}
```
