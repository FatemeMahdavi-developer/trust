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
        'size_id',
        'state',
        'order',
        'number_box'
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
        if(!empty($params['size_id'])){
            $builder->where("size_id",$params["size_id"]);
        }
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }

        return $builder;
    }

    public function size(){
        return $this->belongsTo(size::class,'size_id');
    }

}
