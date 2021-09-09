<?php

require './vendor/autoload.php';

use ZerosDev\LinkQu\Constant;

$linkqu = new ZerosDev\LinkQu\Client(function ($client) {
    $client->setMode(Constant::DEVELOPMENT)
        ->setClientId('testing')
        ->setUsername('LI801D8G7')
        ->setClientSecret('123');
});

$admin = $linkqu->administration();

// var_dump($admin->banks());
// var_dump($admin->emoney());
var_dump($admin->resumeAccount());
