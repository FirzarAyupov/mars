<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Direction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DirectionTest extends TestCase
{
    #[DataProvider("directionsProvider")]
    public function testChangeDirection($start, $shift, $end)
    {
        $result = Direction::change($start, $shift);

        self::assertEquals($result, $end);
    }

    public static function directionsProvider(): iterable
    {
        yield [Direction::North, -1, Direction::West];
        yield [Direction::North, 0, Direction::North];
        yield [Direction::North, 1, Direction::East];
    }
}
