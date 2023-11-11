<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 *
 */
class Video extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'caption',
        'user_id',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating( function( $video ) {
            $video->user_id = auth()->id();
        } );
    }// boot
}
