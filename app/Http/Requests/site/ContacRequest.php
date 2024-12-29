<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class ContacRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'mobile'=>['required','string','max:11','regex:/[0]{1}[0-9]{10}/'],
            'email'=>['required','email'],
            'catid'=>['required','integer'],
            'note'=>['required','string']
        ];
    }


    public function messages()
    {
        return[
            'catid' => 'فیلد واحد مربوطه اجباری است',
            'note' => 'فیلد متن پیام اجباری است'
        ];
    }
}
