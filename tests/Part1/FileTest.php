<?php

namespace Part1;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use TechTest\Part1\Models\File;

class FileTest extends TestCase
{
    private $file;

    public function setup()
    {
        vfsStream::setup('home');
        vfsStream::create([
            'user1' => []
        ]);
        $file = vfsStream::url('home/user1/test.txt');
        file_put_contents($file, "Some text!");
        $this->file = new File(vfsStream::url('home/user1/test.txt'));

    }

    public function testParentFolder()
    {
        $this->assertInstanceOf('\TechTest\Part1\Models\File', $this->file);
    }

    public function testGetMimeType()
    {
        $mimeType = $this->file->getMimeType();

        $this->assertInternalType('string', $mimeType);
        $this->assertEquals('text/plain', $mimeType);
    }

    public function testGetFileSize()
    {
        $fileSize = $this->file->getFileSize();

        $this->assertInternalType('integer', $fileSize);
//        $this->assertEquals('text/plain', $fileSize);
    }
}
