<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class instagram_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_instagram","update_instagram"])){
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
            'pic' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic' => ['nullable', 'string', 'min:1', 'max:255'],
            'link' => ['nullable', 'string', 'min:1', 'max:255'],
        ];
        if(is_string("pic") && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        return $rules;
    }
}
