<?php

namespace App\Service\Product;

use App\Data\Product\StoreProductData;
use App\Models\Category;
use App\Models\Product;
use App\Service\File\Enum\Path;
use App\Service\File\ImageStoreService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductStoreService
{      
    public function handle(StoreProductData $data, Category $category): bool
    {
        $product = new Product();
        $product->name = $data->name;
        $product->description = $data->description;
        $product->image = $this->getImageName($data->image);
        $product->price = $data->price;
        $product->active = $data->active;
        $product->cost = $data->cost;
        $product->stock = $data->stock;
        
        $product->company()->associate(Auth::guard('api-company')->user());
        $product->category()->associate($category);
        
        if(!$product->save()){
            return false;
        }

        return true;
    }
    
    private function getImageName(?UploadedFile $image): ?string
    {
        if(!$image){
            return null;
        }

        $image =  new ImageStoreService($image);
        return $image->handle(Path::PRODUCT);
    }
}
