<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

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
            'code' => ['required', 'min:1', 'max:8', 'regex:/^(?:[A-Za-z]+|\d+)$/','unique:locker_banks,code'],
            'size'=>['required',  Rule::unique('locker_banks')->where('branch_id',Request()->branch_id) ],
            'branch_id'=>['required','exists:branches,id']
        ];
        if(isset($this->id)){
            $rules['code']=['required', 'min:1', 'max:8', 'regex:/^(?:[A-Za-z]+|\d+)$/', 'unique:locker_banks,code,'.$this->code];
        }
        return $rules;
    }
}
