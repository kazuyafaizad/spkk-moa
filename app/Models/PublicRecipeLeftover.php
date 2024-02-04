<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class PublicRecipeLeftover extends Model
{
    use HasFactory;
    use Searchable;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function created_by_user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
