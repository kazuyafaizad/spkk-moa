<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicAnnouncement extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = ['title', 'image', 'content', 'display_at'];

    protected $appends = ['image_url'];

    public function setDisplayAtAttribute($value)
    {
        $this->attributes['display_at'] = \Carbon\Carbon::parse($value);
    }

    protected $casts = [
        'display_at' => "date:Y-m-d\TH:i",
        'status' => 'boolean',
    ];

    // Define a scope to get announcements that are ready to be displayed based on time
    public function scopeReadyToDisplay($query)
    {
        return $query->where('display_at', '<=', now())->where('status', 1)->orderBy('id', 'desc');
    }

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

    public function getImageUrlAttribute()
    {
        $filedirectory = '/data/spkk/announcement/';

        return route('img-ge', base64_encode($filedirectory.$this->image));
    }
}
