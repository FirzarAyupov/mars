<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Coordinate;
use App\Entity\Direction;
use App\Entity\Rover;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoverTest extends KernelTestCase
{
    public function testCreateRoverWithParameters()
    {
        $coordinate = new Coordinate(1, 4);
        $direction = Direction::North;
        $rover = new Rover($coordinate, $direction);
        self::assertSame($rover->getCoordinate(), $coordinate);
        self::assertSame($rover->getDirection(), $direction);
    }

    /* Ровер повернулся налево - изменилось направление ровера */
    public function testRoverTurnLeft()
    {
        $coordinate = new Coordinate(1, 1);
        $direction = Direction::East;
        $rover = new Rover($coordinate, $direction);
        $newDirection = Direction::change($direction, -1);

        $rover->turnLeft();

        self::assertSame($rover->getDirection(), $newDirection);
    }

    /* Ровер повернулся направо - изменилось направление ровера */
    public function testRoverTurnRight()
    {
        $coordinate = new Coordinate(1, 1);
        $direction = Direction::East;
        $rover = new Rover($coordinate, $direction);
        $newDirection = Direction::change($direction, 1);

        $rover->turnRight();

        self::assertSame($rover->getDirection(), $newDirection);
    }

    /* Ровер поехал вперед - изменилось расположение ровера */
    #[DataProvider("movedProvider")]
    public function testRoverMovedVertical($startCoordinate, $direction, $endCoordinate)
    {
        $rover = new Rover($startCoordinate, $direction);

        $rover->moved();

        self::assertEquals($rover->getCoordinate(), $endCoordinate);
    }

    public static function movedProvider(): iterable
    {
        yield [new Coordinate(1, 2), Direction::North, new Coordinate(1, 3)];
        yield [new Coordinate(1, 2), Direction::South, new Coordinate(1, 1)];
        yield [new Coordinate(1, 2), Direction::East, new Coordinate(2, 2)];
        yield [new Coordinate(1, 2), Direction::West, new Coordinate(0, 2)];
    }
}
