<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasFactory,SoftDeletes;

    const UPDATED_AT = null;
    protected $fillable=[
        'rate_number',
        'rate_kind',
        'user_id'
    ];

}
