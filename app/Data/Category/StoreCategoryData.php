<?php

namespace App\Data\Category;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class StoreCategoryData extends Data
{
    public function __construct(
        public string $name,
        public ?UploadedFile $photo = null,
    ) {}
}
