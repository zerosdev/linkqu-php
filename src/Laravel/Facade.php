<?php declare(strict_types=1);

namespace ZerosDev\LinkQu\Laravel;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
	protected function getFacadeAccessor()
	{
		return 'LinkQu';
	}
}