<?php

namespace App\Services;

class SignPhotoService
{
    public static function store(object $modelData, array $attributes): void
    {
        $photoId = FileUploadService::savePhoto($attributes['image']);

        unset($attributes['image']);

        $modelData->model->externalSignHasSignPhoto()->create($attributes + ['photo_id' => $photoId]);
    }
}
