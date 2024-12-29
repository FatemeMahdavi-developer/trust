<?php

namespace App\Http\Requests\admin;

use App\Rules\subid_in_catid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class gallery_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules= [
            'seo_title' => ['required', 'string', 'min:1', 'max:255'],
            'seo_url' => [
                'required', 'string','min:1','max:255',
                Rule::unique('galleries')->where(function ($query) {
                    return $query->where('kind',$this->kind);
                }),
            ],
            'seo_h1' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_canonical' => ['nullable', 'string', 'min:1'],
            'seo_redirect' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_redirect_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_index_kind' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'min:1', 'max:255'],
            'seo_description' => ['nullable', 'string', 'min:1'],
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'catid' => ['required','integer','exists:gallery_cats,id'],
            'video' =>['required_if:kind,2','nullable','mimes:mp4,mov,ogg,qt','max:'.env('MAXIMUM_FILE')],
            'aparat_video' => ['required_if:kind,2','nullable','string'],
            'is_aparat'=>['required_if:kind,2','nullable','integer','min:0'],
            'pic' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic' => ['nullable','string','min:3','max:255'],
            'pic_banner' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic_banner'=>['nullable','string','min:3','max:255'],
            'note' => ['nullable','string','min:1'],
        ];
        if(isset($this->id)){
            $rules['seo_url']=[
                'required','string','min:1','max:255',
                Rule::unique('galleries')->where(function ($query) {
                    return $query->where('kind',$this->kind);
                })->ignore($this->id),
            ];
        }

        if($this->kind==1){
            unset($rules['seo_title']);
            unset($rules['seo_url']);
        }

        if ($this->is_aparat == 1) {
            unset($rules['video']);
            $rules["aparat_video"]=['required','string'];
        }elseif(!empty($this->video)){
            $rules['is_aparat']=['integer','min:0'];
            $rules['aparat_video']=['nullable','string'];
        }

        if (is_string($this->video) && in_array(pathinfo($this->video, PATHINFO_EXTENSION), ['mp4', 'mov', 'ogg', 'qt'])) {
            unset($rules["video"]);
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

    public function messages()
    {
        return[
            'video.required_if'=>' پر کردن فیلد :attribute اجباری است',
            'aparat_video.required_if'=>' پر کردن فیلد :attribute اجباری است',
            'is_aparat.required_if'=>' پر کردن فیلد :attribute اجباری است'
        ];
    }
}
