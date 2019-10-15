<?php

use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator as paginator;
use Illuminate\Pagination\LengthAwarePaginator;
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


function toRupiah($value)
{
    return 'Rp. '. number_format($value, 0, ",", ".");  
}

function convertBulan($nomorBulan) 
{
    if ($nomorBulan == 1) {
        return 'Januari';
    } else if ($nomorBulan == 2) {
        return 'Pebruari';
    } else if ($nomorBulan == 3) {
        return 'Maret';
    } else if ($nomorBulan == 4) {
        return 'April';
    } else if ($nomorBulan == 5) {
        return 'Mei';
    } else if ($nomorBulan == 6) {
        return 'Juni';
    } else if ($nomorBulan == 7) {
        return 'Juli';
    } else if ($nomorBulan == 8) {
        return 'Agustus';
    } else if ($nomorBulan == 9) {
        return 'September';
    } else if ($nomorBulan == 10) {
        return 'Oktober';
    } else if ($nomorBulan == 11) {
        return 'Nopember';
    } else if ($nomorBulan == 12) {
        return 'Desember';
    }
}

function customPagination($dataQuery, $countDataQuery, $totalPerPage)
{
    // set current page
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    // generate pagination
    $currentResults = $dataQuery->slice(($currentPage - 1) * $totalPerPage, $totalPerPage)->all(); 

    $results = new LengthAwarePaginator($currentResults, $countDataQuery, $totalPerPage);

    return $results;
}

?>
