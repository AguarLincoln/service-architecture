<?php

namespace App\Data\Product;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class ShowProductData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?UploadedFile $image,
        public float $price,
        public bool $active = true,
        public int $cost,
        public ?int $stock = null,
    ) {}
}
