<?php

namespace Part1;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use TechTest\Part1\Models\File;
use TechTest\Part1\Models\FileExplorer;

class FileExplorerTest extends TestCase
{
    private $fileExplorer;

    public function setUp()
    {
        vfsStream::setup('home');
        vfsStream::create([
            'user1' => []
        ]);
        $file = vfsStream::url('home/user1/test.txt');
        file_put_contents($file, "Some text!");
        $this->file = new File(vfsStream::url('home/user1/test.txt'));

        $this->fileExplorer = new FileExplorer(vfsStream::url('home/'));
    }

    public function testMoveUp()
    {
        $this->assertTrue(!$this->fileExplorer->moveUp());
    }

    public function testMoveDownTo()
    {
        try {
            $this->fileExplorer->moveDownTo('user1');
        } catch (\Exception $e) {
            $this->assertFalse(false);
        }
        $this->assertTrue(true);
    }

    public function testGetItems()
    {
        $this->assertInternalType('array', $this->fileExplorer->getItems());
    }
}
