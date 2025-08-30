<?php

namespace App\Models;

use App\Base\Entities\Enums\BoxState;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class box extends Model
{
    use HasFactory,SoftDeletes,date_convert;

    protected $fillable=[
        'title',
        'admin_id',
        'state',
        'order',
        'number_box',
        'locker_bank_id'
    ];


    protected $casts = [
        'state' => BoxState::class,
    ];


    public function enumsLang(): array
    {
        return __('enums');
    }

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }
        if (!empty($params['locker_bank_id'])) {
            $builder->where('locker_bank_id',$params['locker_bank_id']);
        }
        return $builder;
    }

    public function lockerBank(){
        return $this->belongsTo(lockerBank::class,'locker_bank_id');
    }

    public function admin(){
        return $this->belongsTo(admin::class,'admin_id')->select('id','fullname');
    }

}
