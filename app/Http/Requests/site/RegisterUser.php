<?php

namespace App\Http\Requests\site;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
        $rules= [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'rule' => ['required'],
        ];
        if(filter_var($this->username, FILTER_VALIDATE_EMAIL)){
            $rules['username']=['required', 'string','email', 'max:255'];
        }
//        dd(check_mobile($this->username));
        return $rules;
    }

    public function messages()
    {
        return [
            'rule'=>trans('common.request_validation.rule')
        ];
    }
}
