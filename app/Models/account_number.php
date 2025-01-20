<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_number extends Model
{
    use HasFactory,date_convert;

    const UPDATED_AT=null;
    
    public $fillable=[
        'name',
        'bank',
        'card_number',
        'account_number'
    ];

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['name'])) {
            $builder->where('name', 'like', '%' . $params['name'] . '%');
        }
        return $builder;
    }
}
