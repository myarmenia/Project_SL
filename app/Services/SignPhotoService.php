<?php

namespace App\Services;

class SignPhotoService
{
    public static function store(object $man, array $attributes): void
    {
        $photoId = FileUploadService::savePhoto($attributes['image']);

        unset($attributes['image']);

        $man->externalSignHasSignPhoto::create($attributes + ['photo_id' => $photoId]);
    }
}
