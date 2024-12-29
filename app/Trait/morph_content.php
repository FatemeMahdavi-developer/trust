<?php
namespace App\Trait;

use App\Models\content;

trait morph_content
{
    public function content(){
        return $this->morphMany(content::class,"contentable");
    }
}
