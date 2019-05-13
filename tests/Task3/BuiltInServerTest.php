<?php

namespace Tests\Task3;

use PHPUnit\Framework\TestCase;

class BuiltInServerTest extends TestCase
{
    const TEST_REGEX = '/<img src=\"https:\/\/s2\.coinmarketcap\.com\/static\/img\/coins\/32x32\/(1|1027|74)\.png\">/';

    /**
     * @var BuiltInServerRunner
     */
    private $runner;

    public function testBuiltInServerRuns()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $this->assertContains('<title>Built-in Web Server</title>', $page);
    }

    public function testShowsAllLinks()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $this->assertRegExp(self::TEST_REGEX, $page);
    }

    public function testCoinsAmount()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $this->assertCount(3, $matches);
    }

    public function testCoinsInfoRendered()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all('/([a-zA-Z]+)\: (\d+)/', $page, $matches, PREG_SET_ORDER, 0);

        $names = array_map(function ($match) {
            return $match[1];
        }, $matches);

        $expected = ['Bitcoin', 'Ethereum', 'Dogecoin'];

        $this->assertCount(3, $names);
        $this->assertCount(0, array_diff($expected, $names));
    }

    public function testCoinsLogoRendered()
    {
        $page = file_get_contents(BuiltInServerRunner::TEST_ENDPOINT);

        $matches = [];

        preg_match_all(self::TEST_REGEX, $page, $matches, PREG_SET_ORDER, 0);

        $logoIds = array_map(function ($match) {
            return $match[1];
        }, $matches);

        $expected = ['1', '1027', '74'];

        $this->assertCount(3, $logoIds);
        $this->assertCount(0, array_diff($expected, $logoIds));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->runner = new BuiltInServerRunner();
        $this->runner->start();
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->runner->stop();
    }
}
