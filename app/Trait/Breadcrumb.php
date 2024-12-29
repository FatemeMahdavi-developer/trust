<?php

namespace App\Trait;

trait Breadcrumb{

    public function parent($foreign_key='catid')
    {
        return $this->belongsTo(self::class,$foreign_key);
    }
    public function parents()
    {
        $parents=collect();
        $category=$this;
        while ($category->parent){
            $parents->push($category->parent);
            $category = $category->parent;
        }
        return $parents->reverse();
    }
}

?>