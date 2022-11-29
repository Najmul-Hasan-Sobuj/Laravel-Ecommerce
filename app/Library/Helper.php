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
        if (!File::isDirectory(storage_path("app/public/requestImg/"))) {
            File::makeDirectory(storage_path("app/public/requestImg/", 0777, true, true));
        }
        if (!File::isDirectory(storage_path("app/public/thumb/"))) {
            File::makeDirectory(storage_path("app/public/thumb/", 0777, true, true));
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
        $currentTime      = Str::random(16) . time();
        $fileName         = $currentTime . '.' . $fileExtention;

        $mainFile->storeAs('public/', $fileName);
        $img = Image::make($mainFile)->resize($reqWidth, $reqHeight)->save($path . '/requestImg/' . $fileName);
        $img->resize(146, 204)->save($path . '/thumb/' . $fileName);

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
        $currentTime      = Str::random(16) . time();
        $fileName         = $currentTime . '.' . $fileExtention;

        $mainFile->storeAs('public/', $fileName);
        $img = Image::make($mainFile)->resize($reqWidth, $reqHeight)->save($path . '/requestImg/' . $fileName);
        $img->resize(146, 204)->save($path . '/thumb/' . $fileName);

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
