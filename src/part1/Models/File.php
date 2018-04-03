<?php

namespace TechTest\Part1\Models;


use finfo;

class File
{
    private $path;

    public function __construct(string $aFilePath)
    {
        $this->path = $aFilePath;
    }

    public function parentFolder()
    {
        return substr($this->path, 0, strpos($this->path, '/', -1));
    }

    public function getMimeType()
    {
        $fileInfo = new Finfo($this->path);
        return $fileInfo->finfo($this->path);
    }

    public function getFileSize()
    {
        filesize($this->path);
    }
}