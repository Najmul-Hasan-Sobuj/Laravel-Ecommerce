<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


/**
 * this imageUpload function is globally upload any images
 * 
 */
class Helper
{
    /**
     * generates the image path if the image path does not exist.
     */
    public static function imageDirectory()
    {
        if (!File::isDirectory("public/requestImg/")) {
            File::makeDirectory("public/requestImg/", 0777, true, true);
        }
        if (!File::isDirectory("public/thumb/")) {
            File::makeDirectory("public/thumb/", 0777, true, true);
        }
    }

    /**
     * upload multiple images.
     * 
     * 'required|image|mimes:png,jpg,jpeg|max:5000', 
     * dimensions:min_width=250,min_height=500
     * dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000
     */
    public static function multipleImageUpload($mainFile, $imgPath, $reqWidth = false, $reqHeight = false)
    {
        $fileExtention    = $mainFile->getClientOriginalExtension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size        = $mainFile->getSize();
        $path             = $imgPath;
        $currentTime      = 'img_' . Str::random(16) . time();
        $fileName         = $currentTime . '.' . $fileExtention;

        $mainFile->storeAs($path, 'Original_' . $fileName);
        $img = Image::make($mainFile)->resize($reqWidth, $reqHeight)->save($path . '/requestImg/' . 'Resize_' . $fileName);
        $img->resize(40, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/thumb/' . $fileName);

        $output['status']             = 1;
        $output['file_name']          = $fileName;
        $output['file_original_name'] = $fileOriginalName;
        $output['file_extention']     = $fileExtention;
        $output['file_size']          = $file_size;

        return $output;
    }

    /**
     * upload single image
     */
    public static function singleImageUpload($mainFile, $imgPath, $reqWidth = false, $reqHeight = false)
    {
        $fileExtention    = $mainFile->getClientOriginalExtension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size        = $mainFile->getSize();
        $path             = $imgPath;
        $currentTime      = 'img_' . Str::random(16) . time();
        $fileName         = $currentTime . '.' . $fileExtention;

        $mainFile->storeAs($path, 'Original_' . $fileName);
        $img = Image::make($mainFile)->resize($reqWidth, $reqHeight)->save($path . '/requestImg/' . 'Resize_' . $fileName);
        $img->resize(40, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/thumb/' . $fileName);

        $output['status']             = 1;
        $output['file_name']          = $fileName;
        $output['file_original_name'] = $fileOriginalName;
        $output['file_extention']     = $fileExtention;
        $output['file_size']          = $file_size;

        return $output;
    }


    // file uploads methods

    public static function fileUpload()
    {
        //
    }
}
