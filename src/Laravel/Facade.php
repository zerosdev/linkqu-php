<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Laravel;

use ZerosDev\LinkQu\Client;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
