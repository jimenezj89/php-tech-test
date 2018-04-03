<?php

namespace TechTest\Part1\Models;


class Folder
{
    /** @var string */
    public $path;

    public function __construct(string $aFolderPath)
    {
        $this->path = $aFolderPath;
    }

    public function getItems(): array
    {
        $items = [];

        foreach(scandir($this->path) as $folderItem) {
            if (is_dir($folderItem)){
                $item = new Folder($this->path.'/'.$folderItem.'/');
            } else {
                $item = new File($this->path.'/'.$folderItem);
            }
            array_push($items, $item);
        }
        return $items;
    }

    public function getParent()
    {
        return new Folder(substr($this->path, 0, strpos($this->path, '/', -1)));
    }

    public function hasChild(string $aFolderName): bool
    {
        return file_exists($this->path.'/'.$aFolderName);
    }
}