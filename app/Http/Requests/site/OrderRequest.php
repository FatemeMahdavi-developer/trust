<?php

namespace App\Http\Requests\site;

use App\Base\Entities\Enums\OrderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        $rules=[
            'kind_payment'=>['required',Rule::in(array_map(fn($case)=>$case->value,OrderType::cases()))],
            // 'name'=>['required','string','min:1','max:255'],
            // 'bank'=>['required','string','min:1','max:255'],
            // 'account_number_id'=>['required','exists:account_numbers,id'],
            // 'fish_number'=>['required','string','min:3','max:70'],
        ];
        // if($this->kind_payment == OrderType::ONLINE_PAYMENT){
        //     unset($rules['name']);
        //     unset($rules['bank']);
        //     unset($rules['account_number_id']);
        //     unset($rules['fish_number']);
        // }
        return $rules;
    }
}
