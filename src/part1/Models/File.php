<?php

namespace TechTest\Part1\Models;

class File
{
    private $path;

    public function __construct(string $aFilePath)
    {
        $this->path = $aFilePath;
    }

    public function parentFolder()
    {
        return new Folder(substr($this->path, 0, strpos($this->path, '/', -1)));
    }

    public function getMimeType()
    {
        return mime_content_type($this->path);
    }

    public function getFileSize()
    {
        return filesize($this->path);
    }
}