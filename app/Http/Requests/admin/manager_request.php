<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class manager_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_manager","update_manager"])){
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
        $rules = [
            'fullname' => ['required', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'email', 'min:1', 'max:255', 'unique:admins,email'],
            'mobile' => ['required', 'min:1', 'max:20', 'unique:admins,mobile'],
            'province' => ['required', 'exists:provinces,id', 'integer'],
            'role_id' => ['required','exists:roles,id','integer'],
            'city' => ['required', 'exists:cities,id', 'integer'],
            'pic' => ['nullable', 'mimes:jpeg,png,jpg', 'max:' . env('MAXIMUM_FILE')],
            'username' => ['required', 'string', 'min:1', 'max:255', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed',]
//            'password'=>['required','string','min:5','max:255','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/',]
        ];

        // , 'regex:/[0]{1}[0-9]{10}/'
        if (isset($this->id)) {
            unset($rules["password"]);
            $rules["email"]=['required', 'email', 'min:1', 'max:255', 'unique:admins,email,'.$this->id];
            $rules["mobile"]=['required', 'min:1', 'max:20', 'unique:admins,mobile,'.$this->id];
            $rules["username"]=['required', 'min:1', 'max:255', 'unique:admins,username,'.$this->id];
        }

        if (is_string("pic") && in_array(pathinfo($this->pic, PATHINFO_EXTENSION), ['jpeg', 'png', 'jpg'])) {
            unset($rules["pic"]);
        }
        return $rules;
    }

}
