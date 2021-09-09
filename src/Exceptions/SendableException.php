<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Exceptions;

use Exception;

class SendableException extends Exception
{
    /**
     * Report exception
     *
     * @return void
     */
    public function report()
    {
        // ..
    }

    /**
     * Render exception
     *
     * @return mixed
     */
    public function render()
    {
        // ..
    }
}
