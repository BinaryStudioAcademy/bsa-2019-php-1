<?php

namespace Tests\Task1;

use PHPUnit\Framework\TestCase;
use App\Task1\FightArena;
use App\Task1\Fighter;

class FightArenaTest extends TestCase
{
    /**
     * @var FightArena
     */
    private $arena;

    /**
     * @var Fighter
     */
    private $fighter1;

    /**
     * @var Fighter
     */
    private $fighter2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->arena = new FightArena();

        $this->fighter1 = new Fighter(
            1,
            'Ryu',
            100,
            10,
            'https://bit.ly/2E5Pouh'
        );

        $this->fighter2 = new Fighter(
            2,
            'Chun-Li',
            70,
            30,
            'https://bit.ly/2Vie3lf'
        );
    }

    public function testAll()
    {
        $this->arena->add($this->fighter1);
        $this->arena->add($this->fighter2);

        $this->assertCount(2, $this->arena->all());
    }

    public function testAdd()
    {
        $this->arena->add($this->fighter1);
        $this->arena->add($this->fighter2);

        $this->assertEquals($this->fighter1->getId(), $this->arena->all()[0]->getId());
        $this->assertEquals($this->fighter2->getId(), $this->arena->all()[1]->getId());
    }

    public function testMostPowerful()
    {
        $this->arena->add($this->fighter1);
        $this->arena->add($this->fighter2);

        $this->assertEquals(30, $this->arena->mostPowerful()->getAttack());
    }

    public function testMostDamageable()
    {
        $this->arena->add($this->fighter1);
        $this->arena->add($this->fighter2);

        $this->assertEquals(70, $this->arena->mostDamageable()->getHealth());
    }
}
