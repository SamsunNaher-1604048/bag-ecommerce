<?php

namespace App\Trait;

trait ImageTrait
{

    protected function uploadImage( $presentImage, $path, $previousImage = null )
    {
        if( !empty($presentImage) ){
            $imageName = time().'.'.$presentImage->getClientOriginalExtension();
            $presentImage->move(public_path($path), $imageName);

            if( !empty($previousImage) ) {
                $previousImage = public_path($path . '/' . $previousImage);
                if (file_exists($previousImage)) {
                    unlink($previousImage);
                }
            }
            return $imageName;
        }

        return $previousImage;
    }
}
