<?php

namespace App\Service\Filter;

use App\Service\Filter\Interface\FilterInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class OrderBy implements FilterInterface
{
    
    public function __construct(
        /** @var Builder */
        private Builder $query,
        private string $column,
        private string $direction
    )
    {}

    public function handle(): Builder
    {
        return $this->query->orderBy($this->column, $this->direction);
    }
}
