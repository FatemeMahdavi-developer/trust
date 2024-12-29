<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory,date_convert;
    protected $fillable=[
        'name',
        'email',
        'mobile',
        'catid',
        'note',
        'ip_address'
    ];
    
    public function message_cat()
    {
        return $this->belongsTo(message_cat::class, 'catid')->select("id", "title");
    }

    // public function getValidateDateAdminAttribute()
    // {
    //     $validate_date_admin[0] = Jalalian::forge($this->validity_date)->format('Y/m/d');
    //     $validate_date_admin[1] = ltrim(Jalalian::forge($this->validity_date)->format('H'), "0");
    //     $validate_date_admin[2] = ltrim(Jalalian::forge($this->validity_date)->format('i'), "0");
    //     return $validate_date_admin;
    // }

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['catid'])) {
            $builder->where("catid", $params['catid']);
        }
        // if (!empty($params['title'])) {
        //     $builder->where('title', 'like', '%' . request()->get('keyword') . '%');
        // }
        return $builder;
    }

}
