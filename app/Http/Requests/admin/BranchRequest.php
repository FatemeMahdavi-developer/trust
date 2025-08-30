<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_branch","update_branch"])){
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
            'name' => ['required','string','min:3', 'max:255'],
            'code' => ['required', 'string', 'min:1', 'max:255'],
            'postal_code' => ['required', 'string','size:10'],
            'address' => ['required','string','min:3','max:255'],
            'user_id' => ['nullable','integer','exists:users,id'],
        ];
    }
}
