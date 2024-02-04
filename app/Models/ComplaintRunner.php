<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintRunner extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'public_complaint_runners';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'rule_1',
        'rule_2',
        'runner',
    ];
}
