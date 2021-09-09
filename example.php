<?php

require './vendor/autoload.php';

use ZerosDev\LinkQu\Constant;

$linkqu = new ZerosDev\LinkQu\Client(function ($client) {
    $client->setMode(Constant::DEVELOPMENT)
        ->setClientId('testing')
        ->setClientSecret('123')
        ->setUsername('LI801D8G7');
});

$admin = $linkqu->administration();
// var_dump($admin->banks());
// var_dump($admin->emoney());
// var_dump($admin->resumeAccount());


$linkqu = new ZerosDev\LinkQu\Client(function ($client) {
    $client->setMode(Constant::DEVELOPMENT)
        ->setClientId('testing')
        ->setClientSecret('123')
        ->setUsername('LI307GXIN'); // username beda
});

$partnerRef = '54321';
// $report = $linkqu->report();
// var_dump($report->status($partnerRef));
// var_dump($report->reports('2020-02-10', '2020-02-13'));
