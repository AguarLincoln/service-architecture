<?php

namespace App\Service\Category;

use App\Data\Category\ShowCategoryData;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryShowService
{
    public function __construct(

    ){}
    
    
    public function handle(ShowCategoryData $data)
    {   
        return $this->getCategories($data);
    }

    private function getCategories(ShowCategoryData $data): LengthAwarePaginator
    {
        /** @var Builder $query */
        $query = Category::query();
        
        $this->filter($query, $data);

        return $query->paginate(10);
    }

    private function filter(Builder &$query, ShowCategoryData $data): void
    {   
        
        if ($data->hasOrderBy() && $data->hasOrderType()) {
            $query->orderBy($data->order_by->value, $data->order_by_type->value);
        }

        if ($data->hasSearchBy() && $data->hasSearchType()) {
            $query->where($data->search_type->value, 'like', '%' . $data->search_type->value . '%');
        }
    }
}
