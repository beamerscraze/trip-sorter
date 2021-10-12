<?php

declare(strict_types=1);

namespace TripSorter;

final class TripSorter
{
    private function __construct(private LocationMap $started, private LocationMap $ended)
    {
    }

    public static function fromCards(BoardingCard ...$cards): TripSorter
    {
        $list = new self(new LocationMap(), new LocationMap());

        foreach ($cards as $card) {
            $list->addTrip(Trip::fromCard($card));
        }

        return $list;
    }

    public function description(string $separator): Description
    {
        foreach ($this->started->list() as $trip) {
            return $trip->description($separator);
        }
        throw new \LogicException('No Trips found.');
    }

    private function addTrip(Trip $trip): void
    {
        match (true) {
            $this->started->has($trip->start()) || $this->ended->has($trip->end()) => throw new \LogicException(),
            $this->started->has($trip->end()) && $this->ended->has($trip->start()) => $this->combine($trip),
            $this->started->has($trip->end())                                      => $this->prepend($trip),
            $this->ended->has($trip->start())                                      => $this->append($trip),
            default                                                                => $this->newOne($trip)
        };
    }

    private function append(Trip $trip): void
    {
        $this->newOne(
            $this->ended->get($trip->start())->append($trip)
        );

        $this->ended->rm($trip->start());
    }

    private function prepend(Trip $trip): void
    {
        $this->newOne(
            $this->started->get($trip->end())->prepend($trip)
        );

        $this->started->rm($trip->end());
    }

    private function combine(Trip $trip): void
    {
        $combined = $this->ended->get($trip->start())->append($trip);
        $combined = $this->started->get($trip->end())->prepend($combined);

        $this->newOne($combined);

        $this->ended->rm($trip->start());
        $this->started->rm($trip->end());
    }

    private function newOne(Trip $trip): void
    {
        $this->started->add($trip->start(), $trip);
        $this->ended->add($trip->end(), $trip);
    }
}
