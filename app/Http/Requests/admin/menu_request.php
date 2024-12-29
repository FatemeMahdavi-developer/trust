<?php

namespace App\Http\Requests\admin;

use App\Rules\subid_in_catid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class menu_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Gate::any(["create_menu","update_menu"])){
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
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'select_page' => ['required_if:select_page,1','nullable','string','min:0','max:1'],
            'type' => ['required', 'integer', 'min:-128', 'max:127'],
            'open_type' => ['required', 'integer'],
            'pic' => ['nullable','mimes:jpeg,png,jpg,gif,svg,webp','max:'.env('MAXIMUM_FILE')],
            'alt_pic' => ['nullable', 'string', 'min:1', 'max:255'],
            'catid' => ['required', 'integer'],
        ];
        
        if(is_string("pic") && in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
        }
        if(is_null($this->select_page)){
            $rules["url"]=["required","string","min:1","max:255"];
        }else{
            $rules["pages"]=["required","exists:pages,seo_url"];
        }

        if(isset($this->id)){
            if($this->id == $this->catid){
                $rules['catid']=[new subid_in_catid($this->catid)];
            }
        }
        return $rules;
    }
}
