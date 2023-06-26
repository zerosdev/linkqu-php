<?php

require './vendor/autoload.php';

use ZerosDev\LinkQu\Constant;
use ZerosDev\LinkQu\Client;

$linkqu = new Client(function ($client) {
    $client->setMode(Constant::DEVELOPMENT)
        ->setClientId('testing')
        ->setClientSecret('123')
        ->setServerKey('LinkQu@2020')
        ->setUsername('LI307GXIN')
        ->setPin('2K2NPCBBNNTovgB')
        ->setDebug(true);
});

$partnerRef = '54321';

// $admin = $linkqu->administration();

// print_r($admin->banks());
// print_r($admin->emoney());
// print_r($admin->resumeAccount());

// $report = $linkqu->report();

// print_r($report->status($partnerRef));
// print_r($report->reports('2020-02-10', '2020-02-13'));

// $trx = $linkqu->transaction();

// print_r($trx->createVa(function ($trx) {
//     $trx->setAmount(10000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com')
//         ->setBankCode('002');
// }));

// print_r($trx->createVaPermata(function ($trx) {
//     $trx->setAmount(100000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('tes@customer.com');
// }));
// print_r($trx->createVaPermataCurl(function ($trx) {
//     $trx->setAmount(100000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('tes@customer.com');
// }));

// print_r($trx->createDedicatedVa(function ($trx) {
//     $trx->setCustomerId(uniqid())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com')
//         ->setPartnerRef(time())
//         ->setBankCode('013');
// }));

// print_r($trx->updateDedicatedVa(function($trx) {
//     $trx->setCustomerId('613a039e63741')
//         ->setCustomerName('Nama Pelanggan 2')
//         ->setCustomerPhone('081234567890')
//         ->setCustomerEmail('email@customer2.com')
//         ->setPartnerRef(time())
//         ->setBankCode('013');
// }));

// print_r($trx->createRetail(function ($trx) {
//     $trx->setAmount(50000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com')
//         ->setRetailCode('INDOMARET');
// }));

// print_r($trx->createQris(function ($trx) {
//     $trx->setAmount(10000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com');
// }));

// print_r($trx->createOvoPush(function ($trx) {
//     $trx->setAmount(10000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com')
//         ->setEwalletPhone('081234567890')
//         ->setBillTitle('Tagihan Belanja')
//         ->setItem('Nama Item 1', 10000, 'https://google.com/image1.jpg')
//         ->setItem('Nama Item 2', 20000, 'https://google.com/image2.jpg');
// }));

// print_r($trx->createPaymentEwallet(function ($trx) {
//     $trx->setAmount(10000)
//         ->setExpired(60)
//         ->setCustomerId(uniqid())
//         ->setPartnerRef(time())
//         ->setCustomerName('Nama Pelanggan')
//         ->setCustomerPhone('08123456789')
//         ->setCustomerEmail('email@customer.com')
//         ->setRetailCode('PAYDANA')
//         ->setEwalletPhone('081234567890')
//         ->setBillTitle('Tagihan Belanja')
//         ->setItem('Nama Item 1', 10000, 'https://google.com/image1.jpg')
//         ->setItem('Nama Item 2', 20000, 'https://google.com/image2.jpg');
// }));

// $transfer = $linkqu->transfer();

// print_r($transfer->inquiry(function ($transfer) {
//     $transfer->setAmount(10000)
//         ->setBankCode('014')
//         ->setaccountNumber('12454694')
//         ->setPartnerRef('20211223124530');
// }));


// print_r($transfer->send(function ($transfer) {
//     $transfer->setAmount(50000)
//         ->setBankCode('008')
//         ->setaccountNumber('1234566788234')
//         ->setPartnerRef('54321')
//         ->setInquiryRef('119598');
// }));
