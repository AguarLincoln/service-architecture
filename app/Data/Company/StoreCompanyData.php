<?php

namespace App\Data\Company;

use Spatie\LaravelData\Data;

class StoreCompanyData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $logo = null,
    ) {}
}
