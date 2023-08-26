<?php

namespace App\Service\File;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageStoreService
{
    const PATH = 'categories';

    public function __construct(
        
    ){}
    
    
    public function handle(UploadedFile $image): ?string
    {
        
        $name = Carbon::now()->format('YmdHis') . '_' . $image->getClientOriginalName();

        try{
            Storage::disk('local')->putFileAs(
                self::PATH,
                $image,
                $name
            );

            return $name;
        }catch(\Exception $e){
            Log::error('ImageStoreService', [ 'error' => $e->getMessage()]);
            return null;
        }

        
    }

    
}
