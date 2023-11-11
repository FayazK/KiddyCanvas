<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoCreateRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class VideoController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return VideoResource::collection( Video::query()->paginate( 10 ) );
    }// index

    /**
     * @return AnonymousResourceCollection
     */
    public function userVideos()
    {
        return VideoResource::collection( Video::query()
                                               ->where( 'user_id', auth()->id() )
                                               ->paginate( 10 ) );
    }// userVideos

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store( VideoCreateRequest $request )
    {
        /**
         * @var Video $video
         */
        $video = Video::query()->create( [
            'caption' => $request->caption,
        ] );
        $video->addMediaFromRequest( 'video' )->toMediaCollection( 'video' );

        return VideoResource::make( $video );
    }// store

}
