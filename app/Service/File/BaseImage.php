<?php

namespace App\Service\File;

use App\Service\File\Enum\TypeImages;
use App\Service\File\Interface\ImageInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

abstract class BaseImage implements ImageInterface
{

    public function __construct(
        protected UploadedFile $image
    ){
        $this->setImage($image);
    }

    public function setImage(mixed $image): void
    {
        if(!$this->isImage()){
            throw new \Exception(__('File is not image'));
        }

        $this->image = $image;
    }

    public function isImage(): bool
    {
        if(!$this->image instanceof UploadedFile){
            return false;
        }
        
        return in_array($this->image->getMimeType(), TypeImages::getMimes());
    }
    
    public function getName(): string
    {
        return Carbon::now()->format('YmdHis') . '_' . str()->random(5);
    }

}
