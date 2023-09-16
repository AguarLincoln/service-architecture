<?php

namespace App\Service\File\Enum;

use Mockery\Matcher\Type;

enum TypeImages: string
{
    case JPEG = 'image/jpeg';
    case PNG = 'image/png';
    case JPG = 'image/jpg';
    case GIF = 'image/gif';
    case SVG = 'image/svg+xml';

    public function getExtensions(): array
    {
        return match($this->value){
            self::JPEG->value => ['jpeg', 'jpg'],
            self::PNG->value => ['png'],
            self::JPG->value => ['jpg'],
            self::GIF->value => ['gif'],
            self::SVG->value => ['svg'],
        };
    }

    public static function getMimes(): array
    {
        $mimes = [];
        foreach(TypeImages::cases() as $type){
            $mimes[] = $type->value;
        }

        return $mimes;
    }

}