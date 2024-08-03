<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Exception;

class ImageUploadService
{
    /**
     * Upload an image to Cloudinary and return its secure path.
     *
     * @param UploadedFile $file
     * @return string
     * @throws Exception
     */
    public function upload(UploadedFile $file)
    {
        try {
            $imageUpload = cloudinary()->upload($file->getRealPath())->getSecurePath();
            return $imageUpload;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
