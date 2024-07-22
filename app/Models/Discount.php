<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trip_id', 'discount_type', 'discount_value', 'start_at', 'end_at', 'active'
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

}
