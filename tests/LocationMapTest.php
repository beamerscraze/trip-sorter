<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use TripSorter\LocationMap;
use TripSorter\Locations\Airport;
use TripSorter\BoardingCards\BusTicket;
use TripSorter\Trip;

final class LocationMapTest extends TestCase
{
    public function testAdd(): void
    {
        $map = new LocationMap();
        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));

        $map->add($trip->start(), $trip);

        $this->assertTrue($map->has($trip->start()));
    }

    public function testRm(): void
    {
        $map = new LocationMap();
        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));
        $map->add($trip->start(), $trip);

        $map->rm($trip->start());

        $this->assertFalse($map->has($trip->start()));
    }

    public function testGet(): void
    {
        $map = new LocationMap();
        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));
        $map->add($trip->start(), $trip);

        $actual = $map->get($trip->start());

        $this->assertEquals($trip, $actual);
    }
}
