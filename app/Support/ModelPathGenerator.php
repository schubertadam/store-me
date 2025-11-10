<?php

namespace App\Support;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class ModelPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media file.
     * The path structure is: {model_name}/{model_id}/
     */
    public function getPath(Media $media): string
    {
        // use the lowercase, slugged form of the model name (e.g., user or category).
        $modelType = strtolower(class_basename($media->model_type));

        // Use the primary key (ID) of the owning model as the folder name.
        return $modelType . '/' . $media->model_id . '/';
    }

    /*
     * Get the path for the generated thumbnails/conversions of the media file.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    /*
     * Get the path for the responsive images of the media file.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive-images/';
    }
}
