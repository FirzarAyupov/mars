<?php

declare(strict_types=1);

namespace App\Entity;

class Coordinate
{
    public function __construct(
        private readonly int $x,
        private readonly int $y,
    )
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}