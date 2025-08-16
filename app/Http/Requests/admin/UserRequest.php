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
        Request()->merge([
            'legal_information_check' =>Request()->has('legal_information_check') ? '1' : '0',
            'locker_bank_owner' =>Request()->has('locker_bank_owner') ? '1' : '0'

        ]);
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
            'password'=>['nullable','min:8'],
            'legal_information_check'=>['nullable','boolean'],
            'company' => ['nullable','required_if:legal_information_check,true','string','min:2','max:255'],
            'economic_code' => ['nullable','required_if:legal_information_check,1','numeric','digits:11'],
            'national_id' => ['nullable','required_if:legal_information_check,1','numeric','digits:11'],
            'tell2' => ['nullable','required_if:legal_information_check,1','numeric'],
            'registration_number' => ['nullable','required_if:legal_information_check,1','numeric','digits_between:10,20'],
            'province2' => ['nullable','required_if:legal_information_check,1','exists:provinces,id'],
            'city2' => ['nullable','required_if:legal_information_check,1','exists:cities,id'],
            'locker_bank_owner'=>['nullable','boolean'],
        ];
        return $rules;
    }
//    protected function failedValidation(Validator $validator)
//    {
//        dd($validator->errors());
//    }

    public function messages()
    {
        return [
            'national_code.regex'=>'کد ملی اشتباه است',
            'company.required_if'=>'نام شرکت اجباری است',
            'economic_code.required_if'=>'کد اقتصادی اجباری است',
            'national_id.required_if'=>'شناسه ملی اجباری است',
            'tell2.required_if'=>'شماره تلفن ثابت اجباری است',
            'registration_number.required_if'=>'شماره ثبت اجباری است',
            'province2.required_if'=>'نام استان اجباری است',
            'city2.required_if'=>'نام شهر اجباری است',
        ];
    }
}
