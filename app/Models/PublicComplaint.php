<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class PublicComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'running_no',
        'schedule_id',
        'description',
        'pbt_id',
        'scheme_id',
        'park_id',
        'street_id',
        'status_id',
        'created_by',
        'take_action_by',
        'assigned_by',
    ];

    // public function getRouteKeyName(): string
    // {
    //     return base64_encode('running_no');
    // }

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'date:d M Y',
    ];

    protected $appends = ['lampiran', 'btoa'];

    public function pbt()
    {
        return $this->belongsTo(IntegrationPbt::class, 'pbt_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(RefSystem::class, 'status_id', 'id');
    }

    public function street()
    {
        return $this->belongsTo(IntegrationStreet::class, 'street_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(Pemantauan::class, 'schedule_id', 'jadual_id');
    }

    public function park()
    {
        return $this->belongsTo(IntegrationPark::class, 'park_id', 'id');
    }

    public function ppk()
    {
        return $this->belongsTo(User::class, 'take_action_by', 'id');
    }

    // public function lampiran()
    // {
    //     return $this->hasMany(PublicComplaintLampiran::class, 'public_complaint_id', 'id');
    // }

    public function getBtoaAttribute()
    {
        return base64_encode($this->running_no);
    }

    public function getLampiranAttribute()
    {
        $http = Http::withoutVerifying()->post('https://spkkv2.swcorp.my/api/public/complaint/get-complaint-attachment', [
            'public_complaint_id' => $this->id,
            'token' => '$2y$10$7z0tkRxf3.aHSzu48i4BiOJTuCfgi0kktC.U8Pmg/1ark0WCpzWWm',
        ]);

        if ($http->successful()) {
            // dd($http->collect());
            return $http->collect()['attachment_link'];
        }
    }
}
