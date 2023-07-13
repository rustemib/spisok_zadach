<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function saveImage($imageFile)
    {
        $filename = time() . '.' . $imageFile->getClientOriginalExtension();
        $location = public_path('images/' . $filename);
        $img = Image::make($imageFile);
        $img->save($location);

        return '/' . $filename;
    }
}
