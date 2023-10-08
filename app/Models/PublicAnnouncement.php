<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'content', 'display_at'];

    // Define a mutator to convert the 'display_at' attribute to a datetime object
    public function setDisplayAtAttribute($value)
    {
        $this->attributes['display_at'] = \Carbon\Carbon::parse($value);
    }

    protected $casts = [
        'display_at' => "date:Y-m-d\TH:i",
        'status' => 'boolean'
    ];

    // Define a scope to get announcements that are ready to be displayed based on time
    public function scopeReadyToDisplay($query)
    {
        return $query->where('display_at', '<=', now());
    }
}
