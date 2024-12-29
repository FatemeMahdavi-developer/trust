<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\employment_request;
use App\Models\employment;
use App\Models\employment_languages;
use App\Models\employment_section;
use App\Models\province;
use App\Trait\date_convert;
use App\Trait\ResizeImage;
use App\Trait\seo_site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class EmploymentController extends Controller
{
    use seo_site,date_convert,ResizeImage;

    public function __construct(public string $module='',public string $module_title='',public string $module_pic='',)
    {
        $this->module="employment";
        $this->module_title=app("setting")[$this->module.'_title'] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module.'_pic'] ?? '';
    }

    public function show()
    {
        $provinces=province::where('state','1')->get(['id','name']);
        $seo=$this->seo_site($this->module);
        $employment_section=employment_section::where('state','1')->orderByRaw('`order` ASC,`id` DESC')->get(['id','name'])->pluck('name','id')->toArray();     
       
        return view('site.'.$this->module,[
            'module'=> $this->module,
            'module_title'=> $this->module_title,
            'module_pic'=> $this->module_pic,
            'employment_section'=> $employment_section
        ],compact('provinces','seo'));
    }

    public function store(employment_request $request)
    {
        // change   $request->.... to $inputs
        DB::beginTransaction();
        try {
            $inputs=$request->validated();
            $inputs['state']='0';
            $inputs['admin_id']=0;
            if($inputs['date_birth']){
                $inputs['date_birth']=CalendarUtils::createCarbonFromFormat('Y/m/d',$inputs['date_birth'])->format('Y-m-d H:i:s');
            }
            $employment=employment::create($inputs);

            if(!empty($inputs['cv_file'])){
                $this->employment_file($employment);
            }
            if(!is_null($request->studdies['studdies_grade'][0])){ 
                $this->employment_studdies($employment,$request->studdies);
            }
            if(!is_null($request->resume['resume_organization'][0])){ 
                $this->employment_resume($employment,$request->resume);
            }
            if(!is_null($request->languages['languages_name'][0])){  //languages_name is first index of array
                $this->employment_languages($employment,$request->languages);
            }
        } catch (Exception $e){
             DB::rollBack();
             return back()->with('fail_action','ارسال با مشکل مواجه شد لطفا دوباره فرم استخدام را پر کنید');
        }
        DB::commit();
        return back()->with('success','درخواست شما با موفقیت افزوده شد منتظر تماس کارشناسان ما باشید');
    }

    private function employment_languages(employment $employment,$input_language=[]){
        foreach($input_language['languages_name'] as $k=>$v){  
            if(!is_null($input_language['languages_name'][$k])){
                $employment->languages()->create([
                    'title'=>$input_language['languages_name'][$k],
                    'write'=>$input_language['languages_writing'][$k],
                    'read'=>$input_language['languages_read'][$k],
                    'conversation'=>$input_language['languages_conversation'][$k]
                ]);
            }
        }
    }

    private function employment_studdies(employment $employment,$input_studdies=[]){
        foreach($input_studdies['studdies_grade'] as $k=>$v){  
            if(!is_null($input_studdies['studdies_grade'][$k])){
                $employment->studdies()->create([
                    'title'=>$input_studdies['studdies_grade'][$k],
                    'field_study'=>$input_studdies['studdies_string'][$k],
                    'name_training'=>$input_studdies['studdies_name_training'][$k],
                    'year_graduation'=>$input_studdies['studdies_year_graduation'][$k]
                ]);
            }
        }

    }

    private function employment_resume(employment $employment,$input_resume=[]){
        foreach($input_resume['resume_organization'] as $k=>$v){ 
            if(!is_null($input_resume['resume_organization'][$k])){
                $employment->organization()->create([
                    'name'=>$input_resume['resume_organization'][$k],
                    'last_side'=>$input_resume['resume_last_side'][$k],
                    'cooperation_time'=>$input_resume['resume_cooperation'][$k],
                    'cooperation_end'=>$input_resume['resume_cooperation_end'][$k],
                    'cooperation_reason'=>$input_resume['resume_cooperation_reason'][$k]
                ]);
            }
        }
    }

    private function employment_file(employment $employment){
        $file=$this->upload_file($this->module,'cv_file');
        $employment->cv_file()->create([
            'file'=>$file,
        ]);
    }
   
}
