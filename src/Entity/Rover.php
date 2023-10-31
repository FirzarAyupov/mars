<?php

declare(strict_types=1);

namespace App\Entity;

class Rover
{
    public function __construct(
        private Coordinate $coordinate,
        private Direction $direction
    )
    {
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function turnLeft(): void
    {
        $this->direction = Direction::change($this->direction, -1);
    }

    public function turnRight(): void
    {
        $this->direction = Direction::change($this->direction, 1);
    }

    public function moved(): void
    {
        $x = $this->coordinate->getX();
        $y = $this->coordinate->getY();
        $dir = $this->direction;

        switch ($dir) {
            case Direction::North: $y += 1; break;
            case Direction::East:  $x += 1; break;
            case Direction::South: $y -= 1; break;
            case Direction::West:  $x -= 1; break;
        }

        $this->coordinate = new Coordinate($x, $y);
    }
}
