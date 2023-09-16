<?php

namespace App\Service\Product;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductShowService
{
    public function __construct(
    ){}
    
    
    public function handle(int $paginate): LengthAwarePaginator
    {   
        return Product::paginate($paginate);
    }
}
