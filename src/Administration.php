<?php declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Administration
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function banks()
	{
		try {
			$response = $this->client->connector()->get('linkqu-partner/masterbank/list');
			$body = $response->getBody()->getContents();
			$data = json_decode($body);
			if( json_last_error() !== JSON_ERROR_NONE ) {
				$this->client->addDebug($body);
				throw new Exception("Invalid JSON response");
			}
			return $data;
		} catch(Exception $e) {
			$this->client->addError($e->getMessage(), ($e instanceof SendableException));
			return false;
		}
	}
}