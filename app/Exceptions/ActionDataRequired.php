<?php

namespace App\Exceptions;

use App\Actions\Action;
use RuntimeException;

class ActionDataRequired extends RuntimeException
{
    /**
     * @param  class-string<Action>  $actionClass
     */
    public function __construct(string $actionClass)
    {
        parent::__construct("Data is required for action: $actionClass", code: 400);
    }
}
