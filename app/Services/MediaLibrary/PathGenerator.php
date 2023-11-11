<?php

namespace App\Services\MediaLibrary;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

/**
 *
 */
class PathGenerator extends DefaultPathGenerator
{
    /**
     * @param Media $media
     *
     * @return string
     */
    protected function getBasePath( Media $media ) : string
    {
        return Str::plural( class_basename( $media->model_type ) ) . '/' . $media->collection_name . '/' . $media->model_id;
    }

}// PathGenerator
