<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PublicComplaintLampiran extends Model
{
    use HasFactory;

    protected $table = 'public_complaint_lampiran';

    protected $appends = ['full_image_path'];

    protected function fullImagePath(): Attribute
    {
        return new Attribute(
            get: fn () => Storage::url('aduan/'.$this->file_name),
        );
    }
}
