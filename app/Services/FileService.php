<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;

class FileService
{
    public function upload(HasMedia $model, UploadedFile $file, string $collection = 'default', bool $single = true): void
    {
        $adder = $model->addMedia($file);

        if ($single) {
            $adder->toMediaCollection($collection);
        } else {
            $adder->preservingOriginal()->toMediaCollection($collection);
        }
    }

    public function uploadMany(HasMedia $model, array $files, string $collection = 'default'): void
    {
        foreach ($files as $file) {
            $this->upload($model, $file, $collection, false);
        }
    }

    public function delete(HasMedia $model, string $collection = 'default'): void
    {
        $media = $model->getFirstMedia($collection);
        if ($media) {
            $media->delete();
        }
    }

    public function getUrl(HasMedia $model, string $collection = 'default', string $conversion = ''): ?string
    {
        return $model->getFirstMediaUrl($collection, $conversion);
    }

    public function getAllMedia(HasMedia $model, string $collectionName = 'thumbnail')
    {
        return $model->getMedia($collectionName);
    }
}
