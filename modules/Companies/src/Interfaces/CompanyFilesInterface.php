<?php

namespace Rezyon\Companies\Interfaces;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

interface CompanyFilesInterface
{
    public function setFile(UploadedFile $file): void;

    public function getFiles(): array;

    public function uploadFiles() :void;
    public function getData():array;
}