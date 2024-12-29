<?php
namespace App\Trait;
use Morilog\Jalali\Jalalian;

trait date_convert
{
    public function date_convert($column='created_at'){
        return Jalalian::forge($this->$column)->format("Y/m/d");
    }
}
