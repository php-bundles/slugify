<?php

namespace SymfonyBundles\Slugify;

class SlugifyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerCreate
     *
     * @param string $source
     * @param string $expected
     */
    public function testGetFileContent(string $source, string $expected)
    {
        $this->assertSame($expected, Slugify::create($source));
    }

    /**
     * @return array
     */
    public function providerCreate(): array
    {
        return [
            [
                'source' => 'example',
                'expected' => 'example.html',
            ],
            [
                'source' => 'Американец украл питона, спрятав его в брюки',
                'expected' => 'amerikanec-ukral-pitona-spratav-ego-v-bruki.html',
            ],
            [
                'source' => 'The start index (in UTF-16 code units) from which the string',
                'expected' => 'the-start-index-in-utf16-code-units-from-which-the-string.html',
            ],
            [
                'source' => 'Новые трейлеры первой короткометражки Containment и всей антологии Alien: 40th'
                    . ' Anniversary Shorts, снятой в честь 40-летия выхода первого «Чужого»',
                'expected' => 'novye-trejlery-pervoj-korotkometrazki-containment-i-vsej-antologii-alien-40th'
                    . '-anniversary-shorts-snatoj-v-cest-40letia-vyhoda-pervogo-cuzogo.html',
            ],
        ];
    }
}
