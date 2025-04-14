<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Tools;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;

class ImageProcessing
{
    public ?string $type = null;
    public ?string $url = null;

    private Filesystem $filesystem;
    private Filesystem\Io\File $fileSystemIo;
    private Filesystem\Driver\File $fileDriver;

    public function __construct(
        Filesystem $filesystem,
        Filesystem\Io\File $fileSystemIo,
        Filesystem\Driver\File $fileDriver
    ) {
        $this->filesystem = $filesystem;
        $this->fileSystemIo = $fileSystemIo;
        $this->fileDriver = $fileDriver;
    }

    public function execute(): ?string
    {
        if (empty($this->url)) {
            return null;
        }

        try {
            $imageData = $this->fileDriver->fileGetContents($this->url);
            $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);

            $path = $this->getPath(true);
            $mediaDirectory->writeFile($path, $imageData);
            return $path;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * @throws FileSystemException
     */
    public function getPath(?bool $isDirectoryCheck = false): string
    {
        $path = "shopreviews/{$this->type}/";

        $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        if ($isDirectoryCheck && !$mediaDirectory->isDirectory($path)) {
            $mediaDirectory->create($path);
        }

        return $path . $this->getFileName();
    }

    private function getFileName()
    {
        if (empty($this->url)) {
            return null;
        }

        return $this->fileSystemIo->getPathInfo($this->url)['basename'];
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
