<?php

use Illuminate\Support\Str;
// use Intervention\Image\File;
// use Intervention\Image\Facades\Image;

function savePhoto($file, $width, $height, $name, $location)
{
        $images = str_slug($name) . time() . '.' . $file->getClientOriginalExtension();
        $path = storage_path('app/public/' . $location); // otomatis masuk ke folder storage

        if (!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($file)->resize($width, $height)->save($path . '/' . $images);
        return $location . '/' . $images;
}

function saveOriginalPhoto($file, $name, $location)
{
        $images = Str::slug($name) . time() . '.' . $file->getClientOriginalExtension();
        $path = storage_path('app/public/' . $location); // otomatis masuk ke folder storage

        if (!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($file)->save($path . '/' . $images);
        return $location . '/' . $images;
}

function numberPagination($pagination)
{
    $number = 1;

    if (request()->has('page') && request()->get('page') > 1) {
       $number += (request()->get('page') - 1) * $pagination;
    }

    return $number;
 }

?>
