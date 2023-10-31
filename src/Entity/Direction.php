<?php

declare(strict_types=1);

namespace App\Entity;

use PhpParser\Node\Scalar\MagicConst\Dir;

enum Direction
{
    case North;
    case East;
    case South;
    case West;

    static function change(Direction $direction, int $shift): Direction
    {
        $directions = self::cases();
        $key = array_search($direction, $directions);
        $newKey = $key + $shift;
        $newKey < 0 && $newKey = $newKey % 4 + 4;
        $newKey > 3 && $newKey = $newKey % 4;

        return $directions[$newKey];
    }
}
