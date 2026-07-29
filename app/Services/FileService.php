<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService extends BaseService
{
    public function uploadImage(UploadedFile $file, string $path = 'settings', ?string $oldFile = null): string
    {
        if ($oldFile) {
            $this->deleteFile($oldFile);
        }
        
        return $file->store($path, 'public');
    }
    
    public function deleteFile(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
