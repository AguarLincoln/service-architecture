<?php

namespace App\Service\Category;

use App\Data\Category\StoreCategoryData;
use App\Models\Category;
use App\Service\File\Enum\Path;
use App\Service\File\ImageStoreService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryStoreService
{
    public function __construct(
    ){}
    
    
    public function handle(StoreCategoryData $data): bool
    {
        $fileName = null;
        
        DB::beginTransaction();

        $category = new Category();
        $category->name = $data->name;
        $category->photo = $this->getImageName($data->photo);
        
        try{
            if($category->save()){
                DB::commit();
                return true;
            }

            DB::rollBack();
            return false;

        }catch(\Exception $e){
            DB::rollBack();
            Log::error('CategoryStoreService', [ 'error' => $e->getMessage()]);
            return false;
        }

        
    }

    private function getImageName(?UploadedFile $image): ?string
    {
        if(!$image){
            return null;
        }
        
        $image =  new ImageStoreService($image);
        return $image->handle(Path::CATEGORY);
    }
    
}
