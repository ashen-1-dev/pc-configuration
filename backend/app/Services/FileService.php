<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uploadFile(string $path, UploadedFile|\File $file): string
    {
        $savedFile = Storage::putFile('public/' . $path, $file);
        return $this->getStaticUrlToFile($savedFile);
    }


    private function getStaticUrlToFile(string $raw): string
    {
        return preg_replace('#/+#', '/', Storage::url($raw));
    }
}
