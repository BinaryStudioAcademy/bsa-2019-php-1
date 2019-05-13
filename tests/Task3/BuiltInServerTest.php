<?php

namespace Tests\Task3;

use PHPUnit\Framework\TestCase;

class BuiltInServerTest extends TestCase
{
    const TEST_REGEX = '/<img src=\"https:\/\/bit\.ly\/(2E5Pouh|2Vie3lf|2VZ2tQd)\">/';

    /**
     * @var BuiltInServerRunner
     */
    private $runner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->runner = new BuiltInServerRunner();
        $this->runner->start();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->runner->stop();
    }

    public function testBuiltInServerRuns()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $this->assertContains('<title>Built-in Web Server</title>', $page);
    }

    public function testShowsAll()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $this->assertRegExp(self::TEST_REGEX, $page);
    }

    public function testFightersAmount()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $this->assertCount(3, $matches);
    }

    public function testFightersInfoRendered()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all('/([a-zA-Z]+)\: (\d+), (\d+)/', $page, $matches, PREG_SET_ORDER, 0);

        $names = array_map(
            function ($match) {
                return $match[1];
            },
            $matches
        );

        $expected = ['Ryu', 'Chun-Li', 'Ken Masters'];

        $this->assertCount(3, $names);
        $this->assertCount(0, array_diff($expected, $names));
    }

    public function testFighterImageRendered()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $imageIds = array_map(
            function ($match) {
                return $match[1];
            },
            $matches
        );

        $expected = ['2E5Pouh', '2Vie3lf', '2VZ2tQd'];

        $this->assertCount(3, $imageIds);
        $this->assertCount(0, array_diff($expected, $imageIds));
    }
}
