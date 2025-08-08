<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class LockerBankRequest extends FormRequest
{
    public function authorize(): bool
    {
        if(!Gate::any(['update_locker_bank','delete_locker_bank'])){
            return false;
        }
        return true;
    }


    public function rules(): array
    {
        $rules= [
            'code' => ['required', 'min:1', 'max:8', 'regex:/^(?:[A-Za-z]+|\d+)$/', 'unique:locker_banks,id'],
            'size'=>['required'],
            'branch_id'=>['nullable','exists:branches,id']
        ];
        if(isset($this->id)){
            $rules['code']=['required', 'min:1', 'max:8', 'regex:/^(?:[A-Za-z]+|\d+)$/', 'unique:locker_banks,id,'.$this->id];
        }
        return $rules;
    }
}
