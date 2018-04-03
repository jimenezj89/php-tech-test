<?php

namespace Part1;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use TechTest\Part1\Models\Folder;

class folderTest extends TestCase
{

    private $filesystem;

    public function setUp()
    {
        $directory = [
            'tmp' => [
                'home' => [
                    'user1' => [
                        'mp3' => [],
                        'music.waw' => 'nice song',
                        'abc.waw' => 'bad song',
                    ],
                    'user2' => [
                        'mp4' => [],
                        'music.waw' => 'nice song',
                        'abc.waw' => 'bad song',
                    ]
                ]
            ]
        ];
        $this->filesystem = vfsStream::setup('root');
    }

    public function testGetItems()
    {
        $folder = new Folder($this->filesystem);

        $children = $folder->getItems();

        $this->assertInstanceOf('array', $children);
    }

    public function testGetParent()
    {
        $folder = new Folder($this->filesystem);

        $parent = $folder->getParent();

        $this->assertInstanceOf('Folder', $parent);
    }

    public function testHasChild()
    {

    }
}
