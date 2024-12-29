<?php

namespace App\Http\Requests\admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_user","update_user"])){
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
        $rules= [
            'name'=>['required','string','min:3','max:255'],
            'lastname'=>['required','string','min:3','max:255'],
            'national_code'=>['required','string','max:10','regex:/^[0-9]{10}$/'],
            'gender'=>['nullable','integer','not_in:0'],
            'mobile'=>['required','string','max:11','regex:/[0]{1}[0-9]{10}/'],
            'email'=>['required','email'],
            'postal_code'=>['nullable','max:10'],
            'province'=>['required','exists:provinces,id'],
            'city'=>['required','exists:cities,id'],
            'address'=>['required','string','min:5','max:255'],
            'date_birth'=>['required','string','regex:/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/'],
            'tell'=>['nullable','min:11','string'],
            'password'=>['nullable','min:8']
        ];
        return $rules;
    }
//    protected function failedValidation(Validator $validator)
//    {
//        dd($validator->errors());
//    }
}
