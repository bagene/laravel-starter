<?php

namespace App\Actions;

use App\DTO\BaseDTO;
use App\Exceptions\ActionDataRequired;
use App\Exceptions\ActionNotFound;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;

/**
 * @template TObject of BaseDTO|null
 */
abstract class Action
{
    /** @var BaseDTO|null */
    protected ?BaseDTO $data = null;

    protected bool $requiresData = false;

    /**
     * @throws ActionNotFound
     */
    public static function make(array $args = []): static
    {
        try {
            return App::makeWith(static::class, $args);
        } catch (BindingResolutionException) {
            throw new ActionNotFound(static::class);
        }
    }

    /**
     * @param  BaseDTO $dto
     */
    public function withData(?BaseDTO $dto): static
    {
        $this->data = $dto;

        return $this;
    }

    public function execute(): mixed
    {
        if ($this->requiresData && $this->data === null) {
            throw new ActionDataRequired(static::class);
        }

        return $this();
    }

    abstract public function __invoke();
}
