<?php

namespace App\Http\Requests\admin;

use App\Rules\subid_in_catid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class product_cat_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_product_cat","update_product_cat"])){
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
        $rules=[
            'seo_title' => ['required', 'string', 'min:1', 'max:255'],
            'seo_url' => ['required', 'string', 'min:1', 'max:255','unique:product_cats,seo_url'],
            'seo_h1' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_canonical' => ['nullable', 'string', 'min:1'],
            'seo_redirect' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_redirect_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_index_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_description' => ['nullable', 'string', 'min:1'],
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'catid' => ['required','integer','min:0'],
            'pic' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic'=>['nullable','string','min:3','max:255'],
            'pic_banner' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic_banner'=>['nullable','string','min:3','max:255'],
            'note' => ['nullable', 'string','min:1', 'max:255'],
        ];
        if(isset($this->id)){
            $rules['seo_url']=['required', 'string', 'min:1', 'max:255','unique:product_cats,seo_url,'.$this->id];
            if($this->id == $this->catid){
                $rules['catid']=[new subid_in_catid($this->catid)];
            }
        }
        if(is_string("pic") && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        if(is_string("pic_banner") && in_array(pathinfo($this->pic_banner,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic_banner']);
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
