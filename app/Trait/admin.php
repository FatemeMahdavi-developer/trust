<?php
namespace App\Trait;

trait admin{
    public function admin(){
        return $this->belongsTo(\App\Models\admin::class,'admin_id');
    }
}
