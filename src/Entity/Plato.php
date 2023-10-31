<?php

declare(strict_types=1);

namespace App\Entity;

class Plato
{
    private array $rovers = [];

    public function __construct(
        private readonly Coordinate $coordinate
    )
    {
        if ($coordinate->getX() < 1 || $coordinate->getY() < 1) {
            throw new \DomainException("Coordinates should be positive");
        }
    }

    public function getAngleCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function getRovers(): array
    {
        return $this->rovers;
    }

    public function setRover(Rover $rover): void
    {
        $rc = $rover->getCoordinate();
        $pc = $this->getAngleCoordinate();

        if ($rc->getX() > $pc->getX() || $rc->getY() > $pc->getY()) {
            throw new \DomainException("Rover is out of plato");
        }

        $this->rovers[] = $rover;
    }
}
