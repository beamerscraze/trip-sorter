<?php

declare(strict_types=1);

namespace TripSorter;

final class Trip
{
    /** @param array<string, BoardingCard> $cards */
    public function __construct(private Location $start, private Location $end, private array $cards)
    {
    }

    public static function fromCard(BoardingCard $card): Trip
    {
        return new self($card->from(), $card->to(), [$card->from()->value => $card]);
    }

    public function start(): Location
    {
        return $this->start;
    }

    public function end(): Location
    {
        return $this->end;
    }

    public function append(Trip $trip): Trip
    {
        if (!$this->end->equals($trip->start)) {
            throw new \InvalidArgumentException('Can\'t append trip.');
        }
        return new self($this->start, $trip->end, $this->cards + $trip->cards);
    }

    public function prepend(Trip $trip): Trip
    {
        if (!$this->start->equals($trip->end)) {
            throw new \InvalidArgumentException('Can\'t prepend trip.');
        }
        return new self($trip->start, $this->end, $this->cards + $trip->cards);
    }

    public function description(string $separator): Description
    {
        $description = $this->cards[$this->start->value]->description();

        $current = $this->cards[$this->start->value];

        while (isset($this->cards[$current->to()->value])) {
            $current = $this->cards[$current->to()->value];

            $description = $description->append($current->description(), $separator);
        }

        return $description->append(new Description('You have arrived to your final destination.'), $separator);
    }
}
