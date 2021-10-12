<?php

declare(strict_types=1);

namespace TripSorter;

/** @psalm-readonly  */
final class Description
{
    public function __construct(public string $value)
    {
        if (empty($this->value)) {
            throw new \InvalidArgumentException('Description can\'t be empty');
        }
    }

    public function append(Description $description, string $separator): Description
    {
        return new Description($this->value . $separator . $description->value);
    }
}
