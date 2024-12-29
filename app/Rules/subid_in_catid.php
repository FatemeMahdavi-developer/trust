<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class subid_in_catid implements Rule
{
  public function __construct(public $catid)
  {
      $this->catid=$catid;
  }

    public function passes($attribute, $value)
    {
       return $value!=$this->catid;
    }

    public function message()
    {
        return 'یک :attribute نمیتواند زیر دسته بندی خودش باشد';
    }
}
