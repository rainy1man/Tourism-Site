<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
     //
    ];

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'category_tour');
    }

    public function categories(): HasMany
    {
        return $this->HasMany(Category::class)->with('categories');
    }
}
