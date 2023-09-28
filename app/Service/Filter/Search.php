<?php

namespace App\Service\Filter;

use App\Service\Filter\Interface\FilterInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class OrderBy implements FilterInterface
{
    // constructor
    public function __construct(
        /** @var Builder */
        private Builder $query,
        private array $colum,
        private string $operator = '=',
        private string $value
    )
    {}

    public function handle(): Builder
    {
        return $this->query->where($this->colum, $this->operator, $this->value);
    }
}
