<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory,date_convert;

    const UPDATED_AT=null;

    protected $appends=['title_size'];

    protected $fillable=[
        'title',
        'price',
        'note',
        'admin_id',
        'state',
        'order'
    ];

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }
        return $builder;
    }


    public function getTitleSizeAttribute(){
        return $this->title.'-'.$this->note;
    }
}
