<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit;

use Kit\Exception\DirectoryNotExistException;
use Kit\FileSystem\Directory;

class Repository
{
    public const DIR_NAME = '.kit';

    public const DIR_GIT_NAME = '.git';

    protected StagingArea $stagingArea;

    protected ObjectDatabase $objectDatabase;

    protected string $path;

    public function __construct(string $basePath)
    {
        $this->path = $basePath . DIRECTORY_SEPARATOR . self::DIR_NAME;
        $this->stagingArea = new StagingArea($this->path);
        $this->objectDatabase = new ObjectDatabase($this->path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getStagingArea(): StagingArea
    {
        return $this->stagingArea;
    }

    public function getObjectDatabase(): ObjectDatabase
    {
        return $this->objectDatabase;
    }

    public function init()
    {
        Directory::create($this->path);
        $this->stagingArea->init();
        $this->objectDatabase->init();
    }

    private function check()
    {
        if (! is_dir($this->path)) {
            throw new DirectoryNotExistException(self::DIR_NAME);
        }
    }
}
