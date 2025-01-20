<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class account_number_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_account_number","update_account_number"])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:1','max:255'],
            'bank'=>['required','string','min:3','max:70'],
            'account_number'=>['required','string','min:12','max:16'], //ToDo
            'card_number'=>['required','digits:16'],
        ];
    }
}
