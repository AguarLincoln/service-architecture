<?php

namespace App\Data\Category;

use App\Enum\Filters\Category\OrderBy;
use App\Enum\Filters\Category\SearchType;
use App\Enum\Filters\OrderByType;
use Spatie\LaravelData\Data;

class ShowCategoryData extends Data
{
    public function __construct(
        public ?OrderBy $order_by,
        public ?OrderByType $order_by_type = OrderByType::ASC,
        public ?string $search_by,
        public ?SearchType $search_type,
    ) {
    }

    // methods has to be named like this: has + property name
    public function hasOrderBy(): bool
    {
        return $this->order_by !== null;
    }

    public function hasOrderType(): bool
    {
        return $this->order_by_type !== null;
    }

    public function hasSearchBy(): bool
    {
        return $this->search_by !== null;
    }

    public function hasSearchType(): bool
    {
        return $this->search_type !== null;
    }
}
