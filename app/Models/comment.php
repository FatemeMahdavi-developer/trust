<?php

namespace App\Models;

use App\Trait\convert_date_to_timestamp;
use App\Trait\date_convert;
use App\Trait\Like;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class comment extends Model
{
    use HasFactory, SoftDeletes, date_convert, convert_date_to_timestamp,Like;

    protected $appends = ['nameModule','fullname','created_at_show'];
    protected $table = 'comments';

    public function commentable()
    {
        return $this->morphTo()->select('id', 'title', 'seo_url');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    protected $fillable = [
        'note',
        'user_id',
        'state',
        'commentable_type',
        'commentable_id',
        'ip_address',
        'response_note',
        'response_created_at',
        'count_like',
        'count_dislike'
    ];

    public function getNameModuleAttribute()
    {
        return trans('modules.module_name.' . class_basename($this->commentable));
    }

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['title'])) {
            $builder->whereHas('commentable', function ($module) use ($params) {
                $module->where('title', 'like', '%' . $params['title'] . '%');
            });
        }
        if (!empty($params['start_time_at'][0])) {
            $start_time = $this->convert_date_to_timestamp($params['start_time_at']);
            $builder->where('created_at', '>=', $start_time);
        }
        if (!empty($params['end_time_at'][0])) {
            $end_time = $this->convert_date_to_timestamp($params['end_time_at']);
            $builder->where('created_at', '<=', $end_time);
        }
        if (isset($params['state'])) {
            $builder->where('state', $params['state']);
        }
        if (isset($params['have_response'])) {
            if ($params['have_response'] == '2') {
                $builder->whereNull('response_note');
            } else {
                $builder->whereNotNull('response_note');
            }
        }
        return $builder;
    }

    public function getCreatedAtShowAttribute($value)
    {
        return Jalalian::forge($value)->format("Y/m/d");
    }

    public function getFullnameAttribute(){
        return $this->user->name." ".$this->user->lastname;
    }

}
