<?php

namespace App\Service\Category;

use App\Data\Category\StoreCategoryData;
use App\Models\Category;
use App\Service\File\ImageStoreService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryStoreService
{
    public function __construct(
        private ImageStoreService $imageService
    ){}
    
    
    public function handle(StoreCategoryData $data): bool
    {
        $fileName = null;
        
        DB::beginTransaction();

        if($data->photo && $data->photo instanceof UploadedFile){
            $fileName = $this->imageService->handle($data->photo);
            
            if(!$fileName){
                DB::rollBack();
                return false;
            }

        }

        $category = new Category();
        $category->name = $data->name;
        $category->photo = $fileName;
        
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

    
}
