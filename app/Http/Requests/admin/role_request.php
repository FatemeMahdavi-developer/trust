<?php

namespace App\Http\Requests\admin;

use App\Models\permissions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class role_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_role","update_role"])){
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
        // dd($this->permissions);
        return [
            "title"=>["required","min:1","max:255","string"],
            'permissions' => 'required|array',
            'permissions.*' => 'integer'
        ];
    }
}
