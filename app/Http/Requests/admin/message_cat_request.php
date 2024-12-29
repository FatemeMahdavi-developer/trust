<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class message_cat_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_message_cat","update_message_cat"])){
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
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'email', 'min:1', 'max:255','unique:message_cats,email'],
            'catid' => ['required','integer','min:0'],
        ];
        if (isset($this->id)) {
            $rules["email"]=['required','email', 'min:1', 'max:255', 'unique:message_cats,email,'.$this->id];
        }
        return $rules;
    }
}
