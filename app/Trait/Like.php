<?php
namespace App\Trait;

trait Like{
    public $module_like=['product','comment'];

    public function like(){
        return $this->morphMany(\App\Models\like::class,"liketable");
    }
}
