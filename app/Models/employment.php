<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment extends Model
{
    use HasFactory,SoftDeletes,date_convert;

    protected $guarded = ['cv_file'];

    const UPDATED_AT = null;

    public function scopeFilter(Builder $builder,$params){

        if(!empty($params['name'])){
            $builder->where('name','like','%'.$params['name'].'%');
        }
        if(!empty($params['work_cooperate'])){
            $builder->where('work_cooperate',$params['work_cooperate']);
        }
        return $builder;
    }

    public function languages() :HasMany
    { 
        return $this->hasMany(employment_languages::class,'employment_id');
    }

    public function studdies() :HasMany
    {
        return $this->hasMany(employment_studdies_grade::class,'employment_id');
    }

    public function organization() :HasMany
    {
        return $this->hasMany(employment_organization::class,'employment_id');
    }

    public function cv_file() :HasOne
    {
        return $this->hasOne(employment_cv::class,'employment_id');
    }

    public function employment_section() :BelongsTo  
    {
        return $this->belongsTo(employment_section::class,'work_cooperate');
    }

    public function provinces() :BelongsTo
    {
        return $this->belongsTo(province::class,'province');
    }

    public function cities() :BelongsTo
    {
        return $this->belongsTo(city::class,'city');
    }
}
