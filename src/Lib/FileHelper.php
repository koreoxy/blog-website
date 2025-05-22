<?php
namespace App\Lib;

class FileHelper
{
    public static function ensureUploadsFolderExists(string $folderPath): void
    {
        if (!is_dir($folderPath)) {
            if (!mkdir($folderPath, 0755, true)) {
                throw new \Exception("Gagal membuat folder: $folderPath");
            }
        }
    }
}
