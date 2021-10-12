<?php

declare(strict_types=1);

namespace TripSorter\BoardingCards;

use TripSorter\BoardingCard;
use TripSorter\Description;
use TripSorter\Locations\Airport;

final class AirplaneTicket implements BoardingCard
{
    public function __construct(
        private Airport $from,
        private Airport $to,
        private string $gate,
        private string $seat
    ) {
    }

    public function from(): Airport
    {
        return $this->from;
    }

    public function to(): Airport
    {
        return $this->to;
    }

    public function description(): Description
    {
        return new Description(
            "From {$this->from->value} Airport, take flight to {$this->to->value}. Gate {$this->gate}, seat {$this->seat}."
        );
    }
}
