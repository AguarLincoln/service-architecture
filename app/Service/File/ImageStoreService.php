<?php

namespace App\Service\File;

use App\Service\File\Enum\Path;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageStoreService extends BaseImage
{  
    public function handle(Path $path = null): ?string
    {   
        $path = $path ?? Path::CATEGORY;
        $name = $this->getName();
        try{
            Storage::disk('local')->putFileAs(
                $path->value,
                $this->image,
                $name
            );

            return $name;
        }catch(\Exception $e){
            Log::error('ImageStoreService', [ 'error' => $e->getMessage()]);
            return null;
        }
    }


    
}
