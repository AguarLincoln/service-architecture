<?php

namespace App\Data\Category;

use App\Service\Filter\Enum\OrderByType;
use Spatie\LaravelData\Data;

class FilterResume extends Data
{
    public function __construct(
      public ?string $order_by,
      public ?OrderByType $order_by_type,
      public ?string $search_by,
      public ?array $search_fields, 
    ) {}
}
