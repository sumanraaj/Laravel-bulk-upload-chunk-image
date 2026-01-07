<?php
namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function generateVariants($path)
    {
        $variants = [256, 512, 1024];
        $manager = new ImageManager(new Driver());
        foreach ($variants as $size) {
            $img = $manager->read($path)->resize($size, null, function ($pic) {
                    $pic->aspectRatio();
                });
            $img->save(str_replace('.jpg', "_{$size}.jpg", $path));
        }
    }
}