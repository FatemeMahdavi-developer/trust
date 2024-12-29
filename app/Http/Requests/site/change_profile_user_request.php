<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class change_profile_user_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
            'date_birth'=>['required','string','regex:/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/'],
            'tell'=>['nullable','min:11','string']
        ];
    }

    public function messages()
    {
        return [
            'national_code.regex'=>'کد ملی اشتباه است'
        ];
    }
}
