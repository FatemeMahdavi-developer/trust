<?php
namespace App\Trait;
trait Comment
{
    public $module_comment=['news','product'];
    public function comment(){
        return $this->morphMany(\App\Models\comment::class,'commentable');
    }
}
