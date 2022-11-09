<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


/**
 * this imageUpload function is globally upload any images
 * 
 */
class Helper
{
    public static function uploadsFunction($mainFile, $imgPath, $reqWidth = false, $reqHeight = false)
    {

        $fileExtention    = $mainFile->getClientOriginalExtension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size        = $mainFile->getSize();

        $validExtentions = array('jpeg', 'jpg', 'png');
        $path            = public_path($imgPath);
        $currentTime     = Str::random(8);
        $fileName        = $currentTime . '.' . $fileExtention;

        if (in_array($fileExtention, $validExtentions)) {
            // $imgDimention = true;
            // if ($reqWidth > 0 || $reqHeight > 0) {
            //     $imgSizeArr = getimagesize($mainFile);
            //     $imgWidth = $imgSizeArr[0];
            //     $imgHeight = $imgSizeArr[1];
            //     if ($reqWidth > 0 && $reqHeight > 0 && ($imgWidth != $reqWidth || $imgHeight != $reqHeight)) {
            //         $imgDimention = false;
            //         $dimentionErrMsg = "Image size must be " . $reqWidth . "px * " . $reqHeight . "px";
            //     } elseif ($reqWidth > 0 && $imgWidth != $reqWidth) {
            //         $imgDimention = false;
            //         $dimentionErrMsg = "Image width must be " . $reqWidth . "px";
            //     } elseif ($reqHeight > 0 && $imgHeight != $reqHeight) {
            //         $imgDimention = false;
            //         $dimentionErrMsg = "Image height must be " . $reqHeight . "px";
            //     }
            // }

            // if ($imgDimention) {
            $mainFile->move($path, $fileName);
            //create instance
            $img = Image::make($path . '/' . $fileName);
            $img = Image::make($path . '/' . $fileName)->resize($reqWidth, $reqHeight)->save($path . '/requestImg/' . $fileName);
            //resize image
            $img->resize(40, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . '/thumb/' . $fileName);

            $output['status']             = 1;
            $output['file_name']          = $fileName;
            $output['file_original_name'] = $fileOriginalName;
            $output['file_extention']     = $fileExtention;
            $output['file_size']          = $file_size;
            // } else {
            //     $output['errors'] = $dimentionErrMsg;
            //     $output['status'] = 0;
            // }
        } else {
            $output['errors'] = $fileExtention . ' File is not support';
            $output['status'] = 0;
        }
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
