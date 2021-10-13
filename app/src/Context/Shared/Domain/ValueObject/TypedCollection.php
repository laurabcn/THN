<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

use App\Domain\Shared\Common\Collection;
use Assert\Assert;

abstract class TypedCollection extends Collection
{
    public function __construct(array $elements)
    {
        Assert::allIsInstanceOf($elements, $this->type());

        parent::__construct($elements);
    }

    abstract protected function type(): string;
}
