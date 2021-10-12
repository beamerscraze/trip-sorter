<?php

declare(strict_types=1);

namespace TripSorter;

interface BoardingCard
{
    public function from(): Location;
    public function to(): Location;

    public function description(): Description;
}
