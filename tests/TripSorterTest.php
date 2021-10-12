<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use TripSorter\BoardingCard;
use TripSorter\Locations\Airport;
use TripSorter\BoardingCards\BusTicket;
use TripSorter\Trip;
use TripSorter\TripSorter;

final class TripSorterTest extends TestCase
{
    /** @dataProvider tickets */
    public function testDescription(BoardingCard $a, BoardingCard $b, BoardingCard $c, string $separator, string $expected): void
    {
        $tripSorter = TripSorter::fromCards($a, $b, $c);

        $description = $tripSorter->description($separator);

        $this->assertEquals($expected, $description->value);
    }


    public function tickets(): array
    {
        $ab = new BusTicket(new Airport('A'), new Airport('B'));
        $bc = new BusTicket(new Airport('B'), new Airport('C'));
        $cd = new BusTicket(new Airport('C'), new Airport('D'));

        $separator = ' ';
        $description = $ab->description()->value . $separator . $bc->description()->value . $separator . $cd->description()->value . $separator . 'You have arrived to your final destination.';

        return [
            [$ab, $bc, $cd, $separator, $description],
            [$ab, $cd, $bc, $separator, $description],
            [$bc, $ab, $cd, $separator, $description],
            [$bc, $cd, $ab, $separator, $description],
            [$cd, $ab, $bc, $separator, $description],
            [$cd, $bc, $ab, $separator, $description],
        ];
    }
}
