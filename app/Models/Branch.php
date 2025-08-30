<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory,SoftDeletes,date_convert;

    const UPDATED_AT=null;

    protected $fillable=[
        'lang',
        'admin_id',
        'state',
        'state_main',
        'order',
        'name',
        'lgmap',
        'qgmap',
        'code',
        'address',
        'postal_code',
        'user_id'
    ];

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['name'])) {
            $builder->where('name', 'like', '%' . $params['name'] . '%');
        }
        return $builder;
    }

    public function lockerbanks()
    {
        return $this->hasMany(LockerBank::class);
    }

}

