<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_name', 'province_id'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

}
