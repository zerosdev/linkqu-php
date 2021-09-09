<?php

require './vendor/autoload.php';

use ZerosDev\LinkQu\Constant;

$linkqu = new ZerosDev\LinkQu\Client(function($client) {
	$client->setMode(Constant::DEVELOPMENT)
		->setClientId('testing')
		->setClientSecret('123');
});

$admin = $linkqu->administration();

var_dump($admin->banks());