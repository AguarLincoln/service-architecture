<?php

namespace App\Service\Filter;

use App\Data\Category\FilterResume;
use App\Service\Filter\Interface\FilterInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Filter
{
    // constructor
    public function __construct(
        /** @var Builder */
        private Builder $query,
        private FilterResume $filterResume
    )
    {}
    
    // public methods 
    public function apply(): Builder
    {
        $this->applyOrderBy();
        $this->applySearch();
        
        return $this->query;
    }
    
    // private methods
    private function applyOrderBy(): void
    {
        if ($this->filterResume->order_by) {
            $this->query->orderBy($this->filterResume->order_by, $this->filterResume->order_by_type);
        }
    }

    private function applySearch(): void
    {
        if ($this->filterResume->search_by && $this->filterResume->search_fields) {
            foreach ($this->filterResume->search_fields as $field) {
                //FAZER ORWHERE
            }
        }
    }
}
