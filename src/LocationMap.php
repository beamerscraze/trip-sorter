<?php

declare(strict_types=1);

namespace TripSorter;

final class LocationMap
{
    /** @param array<string, Trip> $list */
    public function __construct(private array $list = [])
    {
    }

    public function add(Location $location, Trip $trip): void
    {
        $this->list[$location->value] = $trip;
    }

    public function get(Location $location): Trip
    {
        return $this->list[$location->value];
    }

    public function has(Location $location): bool
    {
        return isset($this->list[$location->value]);
    }

    public function rm(Location $location): void
    {
        unset($this->list[$location->value]);
    }

    /** @return  array<string, Trip> */
    public function list(): array
    {
        return $this->list;
    }
}
