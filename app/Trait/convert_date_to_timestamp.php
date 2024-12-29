<?php
namespace App\Trait;

use Morilog\Jalali\Jalalian;

trait convert_date_to_timestamp
{
    public function convert_date_to_timestamp($date_before_convert)
    {
        $date = explode('/', $date_before_convert[0]);
        $timestamp = (new Jalalian($date[0], $date[1], $date[2], $date_before_convert[1] ?? '0', $date_before_convert[2] ?? '0', 0))->toCarbon()->toDateTimeString();
          return $timestamp;
    }
}
