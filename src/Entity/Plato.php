<?php

declare(strict_types=1);

namespace App\Entity;

class Plato
{

    public function __construct(int $x, int $y)
    {
        if ($x < 0 || $y < 0) {
            throw new \InvalidArgumentException('Координаты должны быть больше 0');
        }
    }
}