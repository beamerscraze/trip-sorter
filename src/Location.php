<?php

declare(strict_types=1);

namespace TripSorter;

/** @psalm-readonly */
abstract class Location
{
    public function __construct(public string $value)
    {
        if (empty($this->value)) {
            throw new \InvalidArgumentException('Locations can\'t be empty');
        }
    }

    final public function equals(Location $location): bool
    {
        return $this->value === $location->value;
    }
}
