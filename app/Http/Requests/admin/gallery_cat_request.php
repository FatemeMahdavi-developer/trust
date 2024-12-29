<?php

namespace App\Http\Requests\admin;

use App\Rules\subid_in_catid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class gallery_cat_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules=[
            'seo_title' => ['required', 'string', 'min:1', 'max:255'],
            'seo_url' => [
                'required', 'string','min:1','max:255',
                Rule::unique('gallery_cats')->where(function ($query) {
                    return $query->where('kind',$this->kind);
                }),
            ],
            'seo_h1' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_canonical' => ['nullable', 'string', 'min:1'],
            'seo_redirect' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_redirect_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_index_kind' => ['nullable','string', 'min:1', 'max:255'],
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
            $rules['seo_url']=['required','string','min:1','max:255',
                Rule::unique('gallery_cats')->where(function ($query) {
                    return $query->where('kind',$this->kind);
                })->ignore($this->id),
            ];
            if($this->id == $this->catid){
                $rules['catid']=[new subid_in_catid($this->catid)];
            }
        }
        if(is_string($this->pic) && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        if(is_string($this->pic_banner) && in_array(pathinfo($this->pic_banner,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
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
