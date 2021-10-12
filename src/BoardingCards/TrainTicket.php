<?php

declare(strict_types=1);

namespace TripSorter\BoardingCards;

use TripSorter\BoardingCard;
use TripSorter\Description;
use TripSorter\Locations\RailwayStation;

final class TrainTicket implements BoardingCard
{
    public function __construct(
        private RailwayStation $from,
        private RailwayStation $to,
        private string $train,
        private string $seat
    ) {
    }

    public function from(): RailwayStation
    {
        return $this->from;
    }

    public function to(): RailwayStation
    {
        return $this->to;
    }

    public function description(): Description
    {
        return new Description(
            "Take the train {$this->train} from {$this->from->value} to {$this->to->value}. Sit in seat {$this->seat}."
        );
    }
}
