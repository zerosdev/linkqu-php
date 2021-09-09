<?php declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Closure, Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;
use ZerosDev\LinkQu\Traits\Setter;
use ZerosDev\LinkQu\Traits\Getter;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
	use Setter, Getter;

	protected $connector;
	protected $clientId;
	protected $clientSecret;
	protected $username;
	protected $pin;
	protected $debug = false;
	public $errors = [];
	public $debugs = [];

	public function __construct(Closure $closure)
	{
		$this->setMode(Constant::DEVELOPMENT);

		$closure($this);

		$this->connector = new GuzzleClient([
			'base_uri'		=> (strtolower($this->mode) == Constant::PRODUCTION)
				? Constant::URL_PRODUCTION
				: Constant::URL_DEVELOPMENT,
			'http_errors'	=> false,
			'headers'		=> [
				'Content-Type'	=> 'application/x-www-form-urlencoded',
				'Accept'		=> 'application/json',
				'client-id'		=> $this->clientId,
				'client-secret'	=> $this->clientSecret
			]
		]);
	}

	public function administration(Closure $closure = null)
	{
		$admin = new Administration($this);

		if( $closure !== null ) {
			$closure($admin);
		}
		
		return $admin;
	}

	public function transaction(Closure $closure = null)
	{
		$transaction = new Transaction($this);

		if( $closure !== null ) {
			$closure($transaction);
		}
		
		return $transaction;
	}

	public function addDebug($message)
	{
		if( $this->debug ) {
			$this->debugs[] = $message;
		}

		return $this;
	}

	public function addError($message, bool $safe_to_client = false)
	{
		$this->errors[] = [
			'message' => $message,
			'safe_to_client' => $safe_to_client
		];

		return $this;
	}
}