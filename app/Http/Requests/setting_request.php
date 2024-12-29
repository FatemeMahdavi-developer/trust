<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class setting_request extends FormRequest
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
        $rules=[];
        foreach ($this->all() as $key => $value) {
            
            if (str_contains($key, "pic")) {
                if (is_object($value)) {
                    $rules[$key] = ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:' . env('MAXIMUM_FILE')];
                }elseif (is_string($key) && in_array(pathinfo($value, PATHINFO_EXTENSION), ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp'])) {
                    unset($rules[$key]);
                }
            }

            if (str_contains($key,"video")) {
                if (is_object($value)) {
                    $rules[$key] = ['nullable', 'mimes:mp4,mov,ogg,qt', 'max:' . env('MAXIMUM_FILE')];
                }elseif(is_string($key) && in_array(pathinfo($value, PATHINFO_EXTENSION), ['mp4', 'mov', 'ogg', 'qt'])) {
                    unset($rules[$key]);
                }
            }
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->all() as $key => $value) {
            if (str_contains($key, "pic")) {
                $messages[$key] = "لطفا تصویر را با فرمت مناسب وارد کنید";
            }
            if (str_contains($key, "video")) {
                $messages[$key] = "لطفا ویدیو با فرمت مناسب وارد کنید";
            }
        }
        return $messages;
    }

}
