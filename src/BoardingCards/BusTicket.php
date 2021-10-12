<?php

declare(strict_types=1);

namespace TripSorter\BoardingCards;

use TripSorter\BoardingCard;
use TripSorter\Description;
use TripSorter\Location;
use TripSorter\Locations\Airport;
use TripSorter\Locations\RailwayStation;

final class BusTicket implements BoardingCard
{
    public function __construct(private Location $from, private Location $to, private ?string $seat = null)
    {
    }

    public function from(): Location
    {
        return $this->from;
    }

    public function to(): Location
    {
        return $this->to;
    }

    public function description(): Description
    {
        if ($this->to instanceof Airport) {
            return new Description(
                "Take the airport bus from {$this->from->value} to {$this->to->value}. {$this->seatDescription()}."
            );
        }

        return new Description(
            "Take the bus from {$this->from->value} to {$this->to->value}. 
             {$this->seatDescription()}."
        );
    }

    private function seatDescription(): string
    {
        return isset($this->seat)
            ? "Sit in seat {$this->seat}"
            : 'No seat assignment';
    }
}
