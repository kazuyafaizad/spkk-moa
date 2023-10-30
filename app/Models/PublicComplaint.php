<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
            'schedule_id' ,
            'description' ,
            'pbt_id'  ,
            'scheme_id'  ,
            'park_id' ,
            'street_id'  ,
            'status_id'  ,
            'created_by'  ,
    ];

    protected $casts = [
        'display_at' => "date:Y-m-d\TH:i",
        'status' => 'boolean',
        'created_at' => "date:d M Y",
    ];

    public function pbt()
    {
        return $this->belongsTo(IntegrationPbt::class,'pbt_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function street()
    {
        return $this->belongsTo(IntegrationStreet::class, 'street_id', 'id');
    }
}
