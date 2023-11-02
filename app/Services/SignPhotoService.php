<?php

namespace App\Services;

class SignPhotoService
{
    public static function store(object $man, array $attributes){
//        dd($attributes);
        FileUploadService::savePhoto($man, $attributes['file'],'photo');
        dd($attributes);
        $man->photo::create(array_filter($attributes));
    }
}
