<?php

namespace Tests\Task2;

use App\Task2\EmojiGenerator;
use PHPUnit\Framework\TestCase;

class EmojiGeneratorTest extends TestCase
{
    /**
     * @var EmojiGenerator
     */
    private $generator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new EmojiGenerator();
    }

    public function emojiDataProvider(): array
    {
        return [
            [
                ['🚀', '🚃', '🚄', '🚅', '🚇']
            ]
        ];
    }

    /**
     * @dataProvider emojiDataProvider
     * @param array $expected
     */
    public function test_emoji_yields_correctly(array $expected)
    {
        $generator = $this->generator->generate();

        $this->assertEquals($expected, iterator_to_array($generator));
    }
}
