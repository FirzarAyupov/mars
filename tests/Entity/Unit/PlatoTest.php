<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Coordinate;
use App\Entity\Direction;
use App\Entity\Plato;
use App\Entity\Rover;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlatoTest extends KernelTestCase
{
    /* Создали плато с координатами - плато существует и имеет эти координаты */
    public function testPlatoIsCreated()
    {
        $coordinate = new Coordinate(1, 2);

        $plato = new Plato($coordinate);

        self::assertInstanceOf(Plato::class, $plato);
        self::assertEquals($plato->getAngleCoordinate(), $coordinate);
    }

    /* Создается плато с нулем или отрицательным числом в координатах - генерируется исключение */
    #[DataProvider("incorrectCoordinates")]
    public function testCreatePlatoWithZeroOrNegativeCoordinates($x, $y)
    {
        $coordinate = new Coordinate($x, $y);

        self::expectException('DomainException');
        self::expectExceptionMessage('Coordinates should be positive');
        $plato = new Plato($coordinate);
    }

    /* Ровер добавлен на плато - у плато есть этот ровер */
    public function testAddRoverToPlato()
    {
        $roverCoordinate = new Coordinate(1, 4);
        $roverDirection = Direction::East;
        $plato = new Plato(new Coordinate(5, 5));
        $rover = new Rover($roverCoordinate, $roverDirection);

        $plato->setRover($rover);

        self::assertNotEmpty($plato->getRovers());
        self::assertIsArray($plato->getRovers());
        self::assertCount(1, $plato->getRovers());
        self::assertEquals($plato->getRovers()[0], $rover);
    }

    /* Ровер добавлен за пределы плато - возвращается исключение */
    public function testAddRoverOutOfPlato()
    {
        $roverCoordinate = new Coordinate(10, 10);
        $roverDirection = Direction::East;
        $plato = new Plato(new Coordinate(5, 5));
        $rover = new Rover($roverCoordinate, $roverDirection);

        self::expectException("DomainException");
        self::expectExceptionMessage("Rover is out of plato");
        $plato->setRover($rover);
    }

    public static function incorrectCoordinates(): iterable
    {
        yield [0, 1];
        yield [1, 0];
        yield [-1, 1];
        yield [1, -1];
    }
}
