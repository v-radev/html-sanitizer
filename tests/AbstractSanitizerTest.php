<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\HtmlSanitizer;

use HtmlSanitizer\SanitizerBuilder;
use HtmlSanitizer\SanitizerInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractSanitizerTest extends TestCase
{
    abstract public function createSanitizer(): SanitizerInterface;

    public function provideFixtures(): array
    {
        // Fixtures shared by all sanitizers
        return [

            [
                'hello world',
                'hello world',
            ],
            [
                '&lt;hello world&gt;',
                '&lt;hello world&gt;',
            ],
            [
                '< Hello',
                ' Hello',
            ],
            [
                'Lorem & Ipsum',
                'Lorem &amp; Ipsum',
            ],

            // Unknown tag
            [
                '<unknown>Lorem ipsum</unknown>',
                'Lorem ipsum',
            ],

            // Scripts
            [
                '<script>alert(\'ok\');</script>',
                '',
            ],
            [
                '<noscript>Lorem ipsum</noscript>',
                '',
            ],

            // Styles
            [
                '<style>body { background: red; }</style>',
                '',
            ],

            // Comments
            [
                'Lorem ipsum dolor sit amet, consectetur<!-- comment<script>alert(\'ok\')</script> -->',
                'Lorem ipsum dolor sit amet, consectetur',
            ],

        ];
    }

    public function provideSanitizerInput()
    {
        foreach ($this->provideFixtures() as $fixture) {
            yield $fixture[0] => [$fixture[0], $fixture[1]];
        }
    }

    /**
     * @dataProvider provideSanitizerInput
     */
    public function testSanitize($input, $expectedOutput)
    {
        $this->assertEquals($expectedOutput, $this->createSanitizer()->sanitize($input));
    }

    public function testRemoveNullByte()
    {
        $this->assertSame('Null byte', $this->createSanitizer()->sanitize("Null byte\0"));
        $this->assertSame('Null byte', $this->createSanitizer()->sanitize("Null byte&#0;"));
    }

    public function testDeeplyNestedTagDos()
    {
        $this->assertNotEmpty($this->createSanitizer()->sanitize(str_repeat('<div>T', 20000)));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowInvalidExtension()
    {
        $builder = new SanitizerBuilder();
        $builder->build(['extensions' => ['invalid']]);
    }
}
