<?php

namespace App\Http\Requests\site;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class employment_request extends FormRequest
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
            'name'=>['required','string','min:3','max:255'],
            'middle_name'=>['required','string','min:2','max:255'],
            'province'=>['required','integer','exists:provinces,id'],
            'city'=>['required','integer','exists:cities,id'],
            'date_birth'=>['required','string','regex:/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/'],
            'place_issue'=>['required','string','min:2','max:255'],
            'national_code'=>['required','string','max:10','regex:/^[0-9]{10}$/'],
            'religion'=>['required','string','min:3','max:255'],
            'mobile'=>['required','string','max:255','max:11','regex:/[0]{1}[0-9]{10}/'],
            'tell'=>['required','max:11','string'],
            'tell2'=>['required','max:11','string'],
            'email'=>['required','email','string'],
            'address'=>['required','string'],
            'gender'=>['required','in:1,2'],
            'military'=>['required_if:gender,2','in:1,2'],
            'military_title'=>['required_if:military,2','nullable','string'],
            'married'=>['required','in:1,2'],
            'married_title'=>['nullable','string'],
            'condemnation'=>['required','in:1,2'],
            'illness'=>['required','in:1,2'],
            'work_type'=>['required','in:1,2,3,4'],
            'work_evening'=>['required','in:1,2'],
            'work_operant'=>['required','in:1,2'],
            'work_cooperate'=>['required','exists:employment_sections,id'],
            'work_holidays'=>['required','in:1,2'],
            'insurance_history'=>['required','in:1,2'],
            'work_insurance'=>['required_if:insurance_history,1','nullable','string','max:255'],
            'insurance_number'=>['nullable','max:255'],
            'work_salary'=>['required','string','max:255'],
            // "resume.resume_organization.*"=>['string','max:255'],
            // "resume.resume_last_side.*"=>['string','max:255'],
            // "resume.resume_cooperation.*"=>['string','max:255'],
            // "resume.resume_cooperation_end.*"=>['string','max:255'],
            // "resume.resume_cooperation_reason.*"=>['string','max:255'],
            // "studdies.*"=>['required'],
            // "studdies.studdies_grade.*"=>['required','string','max:255'],
            // "studdies.studdies_string.*"=>['required','string','max:255'],
            // "studdies.studdies_name_training.*"=>['required','string','max:255'],
            // "studdies.studdies_year_graduation.*"=>['required','string','max:255'],
            // "languages.*"=>['required'],
            // "languages.languages_name."=>['required','string','max:255'],
            // "languages.languages_name.*"=>['required','string','max:255'],
            // "languages.languages_writing.*"=>['required','in:1,2,3,4,5'],
            // "languages.languages_conversation.*"=>['required','in:1,2,3,4,5'],
            // "languages.languages_read.*"=>['required','in:1,2,3,4,5'],
            "it_office"=>['required','in:1,2,3,4,5'],
            "it_accounting"=>['required','in:1,2,3,4,5'],
            "reagent_job"=>['required','in:1,2,3,4,5'],
            "it_internet"=>['required','in:1,2,3,4,5'],
            "it_social"=>['required','in:1,2,3,4,5'],
            "it_designing"=>['required','in:1,2,3,4,5'],
            "it_it"=>['required','in:1,2,3,4,5'],
            "it_note"=>['nullable','string'],
            "note_more"=>['nullable','string'],
            "reagent_name"=>['nullable','string','max:255'],
            "reagent_job"=>['nullable','string','max:255'],
            "reagent_relativity"=>['nullable','string','max:255'],
            "reagent_year"=>['nullable','string','max:255'],
            "reagent_tell"=>['nullable','string','max:255'],
            'cv_file' => ['nullable', 'mimes:pdf,docs,png,jpg','max:'.env('MAXIMUM_FILE')],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ];
    }

    public function messages() : array
    {
        return[
            'military.required_if'=>'وضعیت نظام وظیفه اجباری است',
            'military_title.required_if'=>'فیلد :attribute اجباری است',
            'work_insurance.required_if'=>'فیلد :attribute اجباری است',
        ];
    }
}
