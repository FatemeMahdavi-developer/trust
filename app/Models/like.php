<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class like extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id',
        'kind',
        'liketable_type',
        'liketable_id',
    ];

    public function liketable(){
        return $this->morphTo();
    }
}
