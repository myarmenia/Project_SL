<?php

namespace App\Services;

class SignPhotoService
{
    public static function store(object $man, array $attributes ){
        $man->ManExternalSignHasSignPhoto::create(array_filter($attributes));
    }
}
