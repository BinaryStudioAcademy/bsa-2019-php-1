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

        $this->fighter1 = $this->createMock(Fighter::class);
        $this->fighter1->method('getId')->willReturn(1);
        $this->fighter1->method('getHealth')->willReturn(100);
        $this->fighter1->method('getAttack')->willReturn(30);

        $this->fighter2 = $this->createMock(Fighter::class);
        $this->fighter2->method('getId')->willReturn(2);
        $this->fighter1->method('getHealth')->willReturn(50);
        $this->fighter1->method('getAttack')->willReturn(10);
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

        $this->assertEquals($this->fighter1, $this->arena->all()[0]->getId());
        $this->assertEquals($this->fighter2, $this->arena->all()[1]->getId());
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

        $this->assertEquals(50, $this->arena->mostDamageable()->getHealth());
    }
}
