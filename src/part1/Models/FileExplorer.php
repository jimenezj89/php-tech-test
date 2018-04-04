<?php

namespace TechTest\Part1\Models;

final class FileExplorer
{
    /** @var string */
    private $root;
    /** @var Folder */
    private $currentFolder;

    public function __construct(string $root = null)
    {
        $this->root          = is_null($root) ? getcwd() : $root;
        $this->currentFolder = new Folder($this->root);
    }

    public function moveUp()
    {
        if ($this->currentPathIsRootPath()) {
            return false;
        }

        $this->currentFolder = $this->currentFolder->getParent();
    }

    public function moveDownTo(string $aChildFolderName): void
    {
        if ( ! $this->currentFolder->hasChild($aChildFolderName)) {
            throw new \Exception("Folder {$aChildFolderName} does not exists!");
        }

        $this->currentFolder = new Folder($this->currentFolder->path . '/' . $aChildFolderName);
    }

    public function getItems(): array
    {
        return $this->currentFolder->getItems();
    }

    private function currentPathIsRootPath(): bool
    {
        return ($this->root == $this->currentFolder->path) ? true : false;
    }
}