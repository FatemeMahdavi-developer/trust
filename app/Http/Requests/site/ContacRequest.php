<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'box_id'=>['required','integer','exists:boxes,id'],
            'size_id'=>['required','integer','exists:sizes,id'],
            "expired_at.0" => ['required','date_format:Y/m/d'],
            "expired_at.1" => ['required','integer','min:0','max:23'],
            "expired_at.2" => ['required','integer','min:0','max:59'],
            'created_at'=>['nullable'],
        ];
    }
}
