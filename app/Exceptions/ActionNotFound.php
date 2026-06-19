<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Actions\Action;
use Exception;

final class ActionNotFound extends Exception
{
    /**
     * @param  class-string<Action>  $actionClass
     */
    public function __construct(string $actionClass)
    {
        parent::__construct("Action class not found: $actionClass", code: 404);
    }
}
