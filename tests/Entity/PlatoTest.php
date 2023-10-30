<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Plato;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlatoTest extends KernelTestCase
{
    public function testCreatPlatoIsObject()
    {
        $plato = new Plato(1,1);
        self::assertInstanceOf(Plato::class, $plato);
    }

    public function testCreatPlatoWithString()
    {
        self::expectException('TypeError');
        $plato = new Plato('1',1);
    }

    #[DataProvider('negativeNumberProvider')]
    public function testCreatPlatoWithNegativeNumber($x, $y)
    {
        self::expectException('InvalidArgumentException');
        self::expectExceptionMessage('Координаты должны быть больше 0');
        new Plato($x,$y);
    }

    public static function negativeNumberProvider() {
        yield [1, -1];
        yield [-1, 1];
    }


}
