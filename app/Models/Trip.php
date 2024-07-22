<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tour_id', 'price', 'capacity', 'start_at', 'end_at', 'meal', 'stay_class'
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function details(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class, 'detail_trip');
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

}
