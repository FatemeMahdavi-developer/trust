<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class contactmap_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_contactmap","update_contactmap"])){
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
        return [
            'lgmap' => ['required','string','min:1',"max:255"],
            'qgmap' => ['required','string','min:1',"max:255"],
            'zgmap' => ['required','integer','min:1',"max:19"],
            'cgmap' => ['nullable','string',"min:1"],
        ];
    }
}
