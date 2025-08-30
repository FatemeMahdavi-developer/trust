<?php

namespace App\Http\Requests\site;

use App\Base\Entities\Enums\PricingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;


class updatePriceOfLockerBank extends FormRequest
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
            'price'=>['required','array'],
            'price.*'=>['required','numeric'],
            'pricing_type'=>['required','array'],
            'pricing_type.*'=>['required', new Enum(PricingType::class)]
        ];
    }

    public function messages()
    {
        return [
            'price.*'=>'فیلد قیمت اجباری است.',
            'pricing_type.*'=>'فیلد نوع اجاره اجباری است.',
        ];
    }
}
