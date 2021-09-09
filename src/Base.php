<?php declare(strict_types=1);

namespace ZerosDev\LinkQu;

use ZerosDev\LinkQu\Traits\Setter;
use ZerosDev\LinkQu\Traits\Getter;

class Base
{
	use Setter, Getter;

	protected $connector;
	protected $mode;
	protected $client_id;
	protected $client_secret;
	protected $username;
	protected $pin;
	protected $debug = false;
}