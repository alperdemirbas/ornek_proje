<?php

namespace Rezyon\Companies;

use Illuminate\Http\UploadedFile;
use Rezyon\Companies\Interfaces\CompanyFilesInterface;

class CompanyFiles implements CompanyFilesInterface
{
    protected UploadedFile $file;
    protected array $files;
    protected array $data;
    protected string $folder = "";

    public function __construct()
    {


    }

    public function setFile(UploadedFile $file): void
    {
        $this->files[] = $file;
    }

    public function uploadFiles(): void
    {
        foreach ($this->getFiles() as $file) {
            $path = $file->store('demo-request', 's3');
            $this->data[] = ['name' => $path];
        }
    }

    public function getData():array
    {
        return $this->data;
    }
    public function getFiles(): array
    {
        return $this->files;
    }

}