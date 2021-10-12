<?php

namespace Test;

use TripSorter\Locations\Airport;
use TripSorter\Locations\RailwayStation;
use TripSorter\BoardingCards\AirplaneTicket;
use TripSorter\BoardingCards\BusTicket;
use TripSorter\BoardingCards\TrainTicket;
use TripSorter\TripSorter;

include __DIR__ . '/vendor/autoload.php';

$tripSorter = TripSorter::fromCards(
    new AirplaneTicket(new Airport('Stockholm'), new Airport('New York JFK'), '22', '7B'),
    new BusTicket(new RailwayStation('Barcelona'), new Airport('Gerona')),
    new TrainTicket(new RailwayStation('Madrid'), new RailwayStation('Barcelona'), '78A', '45B'),
    new AirplaneTicket(new Airport('Gerona'), new Airport('Stockholm'), '45B', '3A'),
);

echo $tripSorter->description(' ')->value;
