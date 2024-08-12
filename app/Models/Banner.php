<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'banner_type',
        'position',
        'filter',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'filter' => 'string', // اگر لازم باشد، بر اساس نوع داده فیلتر تغییر دهید
    ];

    /**
     * Get the media collection name based on banner_type.
     */
    public function getMediaCollectionName()
    {
        return $this->banner_type . '_banner';
    }

}
