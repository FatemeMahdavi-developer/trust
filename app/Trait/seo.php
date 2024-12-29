<?php

namespace App\Trait;
trait seo
{
    public function h1()
    {
        return $this->seo_h1 ?? $this->title;
    }

    public function keyword()
    {
        if (!empty($this->seo_keyword)) {
            return explode(',', $this->seo_keyword);
        }
        return '';
    }


}
