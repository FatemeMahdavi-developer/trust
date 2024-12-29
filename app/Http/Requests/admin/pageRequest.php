<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class pageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_page","update_page"])){
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
            'seo_title' => ['required', 'string', 'min:1', 'max:255'],
            'seo_url' => ['required', 'string', 'min:1', 'max:255','unique:pages,seo_url'],
            'seo_h1' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_canonical' => ['nullable', 'string', 'min:1'],
            'seo_redirect' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_redirect_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_index_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_description' => ['nullable', 'string', 'min:1'],
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'pic' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic'=>['nullable','string','min:0','max:255'],
            'kind'=>['required','integer'],
            'note'=>['nullable'],
        ];
        if(is_string("pic") && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        if(isset($this->id)){
            $rules['seo_url']=['required', 'string', 'min:1', 'max:255','unique:pages,seo_url,'.$this->id];
        }
        
        return $rules;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'seo_url'=>sluggableCustomSlugMethod($this->seo_url)
        ]);
    }
}
