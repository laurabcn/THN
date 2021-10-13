<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\sort;

class Collection extends ArrayCollection
{
    public static function create(array $elements): static
    {
        return new static($elements);
    }

    public static function createEmpty(): static
    {
        return new static([]);
    }

    public function extract()
    {
        $elements = $this->toArray();
        $this->clear();

        return $this->createFrom($elements);
    }

    public function each(callable $fn): void
    {
        foreach ($this->getIterator() as $key => $element) {
            $fn($element, $key);
        }
    }

    public function all(callable $predicate): bool
    {
        return all($predicate, $this->toArray());
    }

    public function sort(callable $criteria)
    {
        return $this->createFrom(
            sort($criteria, $this->toArray())
        );
    }

    public function reduce(callable $fn, $initialValue)
    {
        return array_reduce($this->toArray(), $fn, $initialValue);
    }
}
