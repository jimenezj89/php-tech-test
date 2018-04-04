<?php

namespace Part1;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use TechTest\Part1\Models\Folder;

class folderTest extends TestCase
{
    private $folder;
    
    public function setUp()
    {
        vfsStream::setup('home');
        $this->folder = new Folder(vfsStream::url('home/'));
    }

    public function testGetItems()
    {
        $children = $this->folder->getItems();

        $this->assertInternalType('array', $children);
        $this->assertEquals(2, count($children));
    }

    public function testGetParent()
    {
        $parent = $this->folder->getParent();

        $this->assertInstanceOf('TechTest\Part1\Models\Folder', $parent);
    }

    public function testHasChild()
    {
        $child = $this->folder->hasChild('user2');

        $this->assertInternalType('bool', $child);
        $this->assertEquals(false, $child);
    }
}
