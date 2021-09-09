<?php declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Administration
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get data bank.
     *
     * @return \stdClass|false
     */
    public function banks()
    {
        $url = 'linkqu-partner/masterbank/list';
        $parameters = [];

        return $this->retrieve($url, $parameters);
    }

    /**
     * Get data emoney
     *
     * @return \stdClass|false
     */
    public function emoney()
    {
        $url = 'linkqu-partner/data/emoney';
        $parameters = [
            'username' => $this->client->username()
        ];

        return $this->retrieve($url, $parameters);
    }

    /**
     * Get data resume account.
     *
     * @return \stdClass|false
     */
    public function resumeAccount()
    {
        $url = 'linkqu-partner/akun/resume';
        $parameters = [
            'username' => $this->client->username()
        ];

        return $this->retrieve($url, $parameters);
    }

    /**
     * Request helper.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return \stdClass|false
     */
    private function retrieve($url, array $parameters = [])
    {
        $parameters = (count($parameters) > 0) ? '?'.http_build_query($parameters) : '';

        try {
            $response = $this->client->connector()->get($url.$parameters);
            $body = $response->getBody()->getContents();
            $data = json_decode($body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->client->addDebug($body);
                throw new Exception('Invalid JSON response');
            }

            return $data;
        } catch (Exception $e) {
            $this->client->addError($e->getMessage(), ($e instanceof SendableException));
            return false;
        }
    }
}
