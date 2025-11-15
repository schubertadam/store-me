<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class FileService
{
    /**
     * Uploads a file and attaches it to the given Eloquent model using Spatie Media Library.
     *
     * Automatically handles whether the file should replace an existing file
     * in the collection based on the $single parameter.
     *
     * @param HasMedia $model The Eloquent model instance implementing HasMedia (e.g., User, Product).
     * @param UploadedFile|null $file The file to be uploaded. Nullable if no file was selected.
     * @param string $collection The name of the media collection to attach the file to (default: 'default').
     * @param bool $single If true, the collection is treated as a single-file collection,
     *  meaning the previous file will be deleted upon successful upload
     *  (requires the model to be configured with ->singleFile() on the collection).
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function upload(HasMedia $model, ?UploadedFile $file, string $collection = 'default', bool $single = true): void
    {
        if (!is_null($file)) {
            $adder = $model->addMedia($file);

            if ($single) {
                $adder->toMediaCollection($collection);
            } else {
                $adder->preservingOriginal()->toMediaCollection($collection);
            }
        }
    }

    /**
     * Uploads multiple files and attaches them to the model.
     *
     * This method iterates over an array of files and delegates the upload
     * logic to the singular 'upload' method, ensuring multiple files can exist
     * in the specified collection.
     *
     * @param HasMedia $model The model instance.
     * @param array|null $files An array of UploadedFile objects (e.g., from request()->file('gallery')).
     * @param string $collection The name of the media collection (default: 'default').
     * @return void
     *
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function uploadMany(HasMedia $model, ?array $files, string $collection = 'default'): void
    {
        if (!is_null($files)) {
            foreach ($files as $file) {
                // Calls the singular upload method, setting $single=false to prevent overwriting
                $this->upload($model, $file, $collection, false);
            }
        }
    }

    /**
     * Deletes the first media item found in the specified collection from the model and storage.
     *
     * This is primarily used for single-file collections (e.g., thumbnail, avatar).
     *
     * @param HasMedia $model The model instance.
     * @param string $collection The name of the media collection (default: 'default').
     * @return void
     */
    public function delete(HasMedia $model, string $collection = 'default'): void
    {
        $media = $model->getFirstMedia($collection);
        if ($media) {
            $media->delete();
        }
    }
}
