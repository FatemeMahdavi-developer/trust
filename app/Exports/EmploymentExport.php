<?php

namespace App\Exports;

use App\Models\employment;
use Maatwebsite\Excel\Concerns\FromCollection;
  

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Symfony\Component\HttpKernel\HttpCache\Esi;

// FromQuery
class EmploymentExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $employments=employment::filter(request()->all())->with(['languages','studdies','organization','cv_file'])->get([
            'id',
            'name',
            'middle_name',
            'province',
            'city',
            'date_birth',
            'place_issue',
            'national_code',
            'religion',
            'mobile',
            'tell',
            'tell2',
            'email',
            'address',
            'gender',
            'military',
            'military_title',
            'married',
            'married_title',
            'condemnation',
            'illness',
            'work_type',
            'work_evening',
            'work_operant',
            'work_cooperate',
            'work_holidays',
            'insurance_history',
            'work_insurance',
            'insurance_number',
            'work_salary',
            'it_office',
            'it_accounting',
            'it_internet',
            'it_social',
            'it_designing',
            'it_note',
            'note_more',
            'reagent_name',
            'reagent_job',
            'reagent_relativity',
            'reagent_year',
            'reagent_tell'
        ]);
        
        return $employments->each(function($item){
            if ($item["province"]) {
                $item["province"]=$item->provinces->name;
            }
            if ($item["city"]) {
                $item["city"]=$item->cities->name;
            }
            if ($item["date_birth"]) {
                $item["date_birth"]=$item->date_convert('date_birth');
            }
            if ($item["gender"]) {
                $item["gender"]=__('employment.gender.'.$item['gender']);
            }
            if ($item["military"]) {
                $item["military"]=__('employment.military.'.$item['military']);
            }
            if ($item["married"]) {
                $item["married"]=__('employment.married.'.$item['married']);
            }
            if ($item["condemnation"]) {
                $item["condemnation"]=__('employment.yes_or_no.'.$item['condemnation']);
            }
            if ($item["illness"]) {
                $item["illness"]=__('employment.yes_or_no.'.$item['illness']);
            }
            if ($item["work_type"]) {
                $item["work_type"]=__('employment.work_type.'.$item['work_type']);
            }
            if ($item["work_evening"]) {
                $item["work_evening"]=__('employment.yes_or_no.'.$item['work_evening']);
            }
            if ($item["work_operant"]) {
                $item["work_operant"]=__('employment.yes_or_no.'.$item['work_operant']);
            }
            if ($item["work_cooperate"]) {
                $item["work_cooperate"]=$item->employment_section->name;
            }
            if ($item["work_holidays"]) {
                $item["work_holidays"]=__('employment.yes_or_no.'.$item['work_holidays']);
            }
            if ($item["insurance_history"]) {
                $item["insurance_history"]=__('employment.yes_or_no.'.$item['insurance_history']);
            }

            $arr=[];
            foreach($item->organization()->select('name','last_side','cooperation_time','cooperation_end','cooperation_reason')->get()->toArray() as $k=>$v){
                $arr[]=implode(',',$v);
            }
            $item['organization']=implode(' / ',$arr);

            $item['it']=__('employment.grade_knowledge.'.$item['it_office']).','.__('employment.grade_knowledge.'.$item['it_accounting']).','.__('employment.grade_knowledge.'.$item['it_internet']).','.__('employment.grade_knowledge.'.$item['it_social']).','.__('employment.grade_knowledge.'.$item['it_designing']);


            $arr=[];
            foreach($item->studdies()->select('title','field_study','name_training','year_graduation')->get()->toArray() as $k=>$v){
                $arr[]=implode(',',$v);
            }
            $item['studdies']=implode(' / ',$arr);


            $arr=[];
            foreach($item->languages()->select('title','write','conversation','read')->get()->toArray() as $k=>$v){
                foreach($v as $k2=>$v2){
                    if($k2!='title'){
                        $v[$k2]= is_null($v2) ? ' - ' : __('employment.grade_knowledge.'.$v2);
                    }
                }
                $arr[]=implode(',',$v);
            }
            $item['languages']=implode(' / ',$arr);

            $arr=[];
            foreach($item->cv_file()->select('file')->get()->toArray() as $k=>$v){
                $arr[]=implode(',',$v);
            }

            $item['reagent']=$item['reagent_name'].' , '.$item['reagent_job']. ' , '.$item['reagent_relativity'].' , '.$item['reagent_year'].' , '.$item['reagent_tell'];

            $item['file']=@$arr[0] ? url($arr[0]) :'ندارد';
            
            unset($item['id']);

            unset($item['it_office']);
            unset($item['it_accounting']);
            unset($item['it_internet']);
            unset($item['it_social']);
            unset($item['it_designing']);

            unset($item['reagent_name']);
            unset($item['reagent_job']);
            unset($item['reagent_relativity']);
            unset($item['reagent_year']);
            unset($item['reagent_tell']);

        });         
    }

    public function headings(): array
    {
        return [
            'نام و نام خانوادگی	',
            'نام پدر',
            'استان',
            'شهر',
            'تاریخ تولد',
            'محل صدور',
            'کد ملی',
            'دین',
            'شماره تلفن همراه',
            'شماره تلفن ثابت',
            'شماره تلفن اضطراری',
            'ایمیل',
            'آدرس',
            'جنسیت',
            'وضعیت نظام وظیفه',
            'نوع معافیت',
            'وضعیت تأهل',
            'تعداد افراد تحت تکفل',
            'سابقه محکومیت کیفری',
            'سابقه بیماری',
            'متقاضی چه نوع کاری هستید',
            'آیا می توانید در ساعات غروب نیز کار کنید',
            'آیا در حال حاضر مشغول به کار هستید',
            'در کدام زمینه تمایل به همکاری دارید',
            'آیا می توانید در ایام پایان هفته یا روزهای تعطیل نیز کار کنید',
            'آیا سابقه پرداخت بیمه دارید',
            'مدت پرداخت بیمه؟ (سال)',
            'شماره بیمه',
            'حقوق درخواستی',
            'فهرست نرم افزارهایی که به آنها تسلط دارید',
            'سایر توضیحات',
            'سوابق شغلی ( به ترتیب از آخرین محل خدمت) (نام سازمان , آخرین سمت , مدت همکاری (سال) , تاریخ پایان همکاری , دلیل قطع همکاری)',
            'آشنایی با کامپیوتر، نرم افزار و شبکه های اجتماعی (مجموعه آفیس شامل Word، Excel و PowerPoint , نرم افزارهای تخصصی حسابداری , ویندوز، اینترنت و ایمیل , شبکه های اجتماعی	, نرم افزارهای طراحی , نرم افزارهای تخصصی حوزه IT)',
            'سوابق تحصیلی (مقطع تحصیلی , رشته , نام مرکز آموزشی , سال اخذ مدرک)',
            'زبان های خارجی (عنوان زبان , سطح مهارت نگارش , سطح مهارت مکالمه , سطح مهارت خواندن)',
            'مشخصات معرف (نام و نام خانوادگی , شغل , نسبت یا نوع آشنایی , مدت آشنایی (سال) , شماره تماس)',
            'فایل پیوست'
        ];
    }
    
}
