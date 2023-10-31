<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Coordinate;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CoordinateTest extends KernelTestCase
{
    public function testCoordinateIsCreated()
    {
        $coordinate = new Coordinate(1,2);

        self::assertInstanceOf(Coordinate::class, $coordinate);
        self::assertSame($coordinate->getX(), 1);
        self::assertSame($coordinate->getY(), 2);
    }

    #[DataProvider('typeErrorInvalidArgumentsProvider')]
    public function testCreatePlatoWithTypeErrorInvalidArguments($x, $y)
    {
        self::expectException('TypeError');
        $coordinate = new Coordinate($x, $y);
    }

    public static function typeErrorInvalidArgumentsProvider(): iterable
    {
        yield [[], 3];
        yield [3, true];
        yield [4, null];
        yield [null, 4];
    }
}
