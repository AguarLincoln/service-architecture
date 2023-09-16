<?php

namespace App\Service\File\Interface;

use App\Service\File\Enum\Path;
use Illuminate\Http\UploadedFile;

interface ImageInterface
{
    
    public function handle(?Path $path = null): ?string;
    public function isImage(): bool;
}

