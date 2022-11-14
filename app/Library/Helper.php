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
     * image path generate or already have.
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

    public static function uploadsFunction($mainFile, $imgPath, $reqWidth = false, $reqHeight = false)
    {
        $fileExtention    = $mainFile->getClientOriginalExtension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size        = $mainFile->getSize();
        $path            = $imgPath;
        $currentTime     = 'img_' . Str::random(16) . time();
        $fileName        = $currentTime . '.' . $fileExtention;

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

    public static function uploadsFile($mainFile, $filepath,)
    {
        $fileExtention    = $mainFile->extension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size        = $mainFile->getSize();

        $validExtentions = array('pdf', 'svg', 'zip', 'rar');
        $path            = public_path($filepath);
        $currentTime     = time();
        $fileName        = $currentTime . '.' . $fileExtention;

        if (in_array($fileExtention, $validExtentions)) {
            $mainFile->move($path, $fileName);

            $output['status']             = 1;
            $output['file_name']          = $fileName;
            $output['file_original_name'] = $fileOriginalName;
            $output['file_extention']     = $fileExtention;
            $output['file_size']          = $file_size;
        } else {
            $output['errors'] = $fileExtention . ' File is not support';
            $output['status'] = 0;
        }
        return $output;
    }
}
