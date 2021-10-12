<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use TripSorter\Locations\Airport;
use TripSorter\BoardingCards\BusTicket;
use TripSorter\Trip;

final class TripTest extends TestCase
{
    public function testAppend(): void
    {
        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));

        $newTrip = $trip->append(Trip::fromCard(new BusTicket(new Airport('B'), new Airport('C'))));

        $this->assertEquals(new Airport('A'), $newTrip->start());
        $this->assertEquals(new Airport('C'), $newTrip->end());
    }

    public function testPrepend(): void
    {
        $trip = Trip::fromCard(new BusTicket(new Airport('B'), new Airport('C')));

        $newTrip = $trip->prepend(Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B'))));

        $this->assertEquals(new Airport('A'), $newTrip->start());
        $this->assertEquals(new Airport('C'), $newTrip->end());
    }

    public function testAppendInvalidTrip(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));

        $trip->append(Trip::fromCard(new BusTicket(new Airport('C'), new Airport('D'))));
    }

    public function testPrependInvalidTrip(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $trip = Trip::fromCard(new BusTicket(new Airport('A'), new Airport('B')));

        $trip->prepend(Trip::fromCard(new BusTicket(new Airport('C'), new Airport('D'))));
    }

    public function testDescription(): void
    {
        $ab = new BusTicket(new Airport('A'), new Airport('B'));
        $bc = new BusTicket(new Airport('B'), new Airport('C'));
        $cd = new BusTicket(new Airport('C'), new Airport('D'));
        $trip = Trip::fromCard($bc)
            ->prepend(Trip::fromCard($ab))
            ->append(Trip::fromCard($cd));

        $description = $trip->description($s = ' ');

        $this->assertEquals(
            $ab->description()->value . $s . $bc->description()->value . $s . $cd->description()->value . $s . 'You have arrived to your final destination.',
            $description->value
        );
    }
}
