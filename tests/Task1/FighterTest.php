<?php

namespace AppTests\Task1;

use App\Task1\Fighter;
use PHPUnit\Framework\TestCase;

class FighterTest extends TestCase
{
    public function fightersDataProvider(): array
    {
        return [
            [
                1,
                'Ryu',
                100,
                10,
                'https://bit.ly/2E5Pouh'
            ],
            [
                2,
                'Chun-Li',
                70,
                30,
                'https://bit.ly/2Vie3lf'
            ],
            [
                3,
                'Ken Masters',
                80,
                20,
                'https://bit.ly/2VZ2tQd'
            ]
        ];
    }

    /**
     * @dataProvider fightersDataProvider
     */
    public function testCreateFighter(int $id, string $name, int $health, int $attack, string $image)
    {
        $fighter = new Fighter(
            $id,
            $name,
            $health,
            $attack,
            $image
        );

        $this->assertEquals($id, $fighter->getId());
        $this->assertEquals($name, $fighter->getName());
        $this->assertEquals($health, $fighter->getHealth());
        $this->assertEquals($image, $fighter->getImage());
    }
}
