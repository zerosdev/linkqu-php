<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Laravel;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'linkqu';
    }
}
