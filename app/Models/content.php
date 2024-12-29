<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class content extends Model
{
    use HasFactory, SoftDeletes, date_convert;

    protected $appends=['alt_image'];

    protected $fillable = [
        'title',
        'kind',
        'pic',
        'note',
        'note_more',
        'pic_video',
        'video',
        'catalog',
        'state',
        'order',
        'is_aparat',
    ];

    public function getAltImageAttribute(){
        // return !empty($this->alt_pic) ? $this->alt_pic : $this->title;
        return $this->title;
    }

    public function scopeFilter(Builder $builder, $params)
    {
        if (isset($params['title'])) {
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        if(isset($params["kind"])){
            $builder->where("kind", $params['kind']);
        }
        return $builder;
    }


    public function contentable()
    {
        return $this->morphTo();
    }

}
