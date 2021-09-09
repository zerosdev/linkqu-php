# linkqu-php
Integration Kit for LinkQu.id

## Requirements
- PHP 7.0+
- PHP JSON Extension
- [Guzzle, PHP HTTP Client](https://github.com/guzzle/guzzle)

## Installation

1. Run command
<pre><code>composer require zerosdev/linkqu-php</code></pre>

### The following steps only needed if you are using Laravel

> For installation on Laravel 5.5+, **SKIP steps 2 & 3** because we have used the Package Discovery feature, Laravel will automatically register the Service Provider and Alias during installation.

2. Open your **config/app.php** and add this code to the providers array, it will looks like:
<pre><code>'providers' => [

      // other providers

      ZerosDev\LinkQu\Laravel\ServiceProvider::class,

],</code></pre>

3. Add this code to your class aliases array
<pre><code>'aliases' => [

      // other aliases

      'LinkQu' => ZerosDev\LinkQu\Laravel\Facade::class,

],</code></pre>

4. Run command
<pre><code>composer dump-autoload</code></pre>

5. Then
<pre><code>php artisan vendor:publish --provider="ZerosDev\LinkQu\Laravel\ServiceProvider"</code></pre>

6. Edit **config/linkqu.php** and put your API credentials

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

        if( $linkqu->hasError() ) {
            print_r($linkqu->errors());
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
