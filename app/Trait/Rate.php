<?php
namespace App\Trait;
trait Rate
{
    public function rate(){
        return $this->morphMany(\App\Models\Rate::class,'ratable');
    }
    public function avg(){
        return round($this->rate()->avg('rate_number'));
    }
    public function count_rate(){
        return $this->rate()->count();
    }
}