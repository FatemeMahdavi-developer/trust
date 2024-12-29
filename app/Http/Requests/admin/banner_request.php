<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class banner_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // show all Gate
        // $gates =Gate::abilities();

        if(Gate::any(["create_banner","update_banner"])){
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
            'type' => ['required', 'integer', 'min:-128', 'max:127'],
            'open_type' => ['required', 'integer'],
            'pic' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'pic_mobile'=>['nullable','required_if:type,1', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic' => ['nullable', 'string', 'min:1', 'max:255'],
            'address' => ['nullable', 'string', 'min:1', 'max:255']
        ];
        if(is_string("pic") && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        if(is_string("pic_mobile") && in_array(pathinfo($this->pic_mobile,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic_mobile']);
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'pic_mobile.required_if'=>'فیلد :attribute اجباری است.',
        ];
    }
}
