<?php

namespace App\Models;

use App\Trait\Breadcrumb;
use App\Trait\date_convert;
use App\Trait\seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class product_cat extends Model
{
   use HasFactory, date_convert,SoftDeletes,seo,Breadcrumb;

   protected $appends=['url'];

   protected $fillable=[
       'seo_title',
       'seo_url',
       'seo_h1',
       'seo_canonical',
       'seo_redirect',
       'seo_redirect_kind',
       'seo_index_kind',
       'seo_keyword',
       'seo_description',
       'admin_id',
       'title',
       'catid',
       'pic',
       'alt_pic',
       'pic_banner',
       'alt_pic_banner',
       'note',
       'order',
       'state',
       'state_main',
       'state_menu'
   ];

   public function getUrlAttribute(){
       return route('product.index_cat',['product_cat'=>$this->seo_url]);
   }

   public function sub_cats(){
       return $this->hasMany(product_cat::class,'catid')->select("id","title","catid","seo_url");
   }

   public function sub_cats_site(){
//        return $this->hasMany(product_cat::class,'catid')->select("id","title","catid","seo_url")->where("state","1");
       return $this->hasMany(product_cat::class,'catid')->where("state","1");
   }

   public function scopeFilter(Builder $builder,$params){
       if(!empty($params['catid'])){
           $builder->where("catid",$params["catid"]);
       }else{
           $builder->where("catid",'0');
       }
       if(!empty($params['title'])){
           $builder->where('title', 'like', '%' . $params["title"] . '%');
       }
       return $builder;
   }

   // public function breadcrumb(){
   //     return product_cat::where('catid',$this->catid)->parents()->where('state','1');
   // }

   public function product(){
       return $this->hasMany(product::class,'catid');
   }


   public function children_ids()
   {
       $a=$this->id;
       foreach ($this->sub_cats_site as $item) {
           if(isset($item->sub_cats_site)){

           }
       }




//        $parents=collect();
//        $category=$this;
//        $a=$category->sub_cats_site;
//        while ($a){
//            dump($a);
//            $parents->push($category->id);
//            $a = $category->sub_cats_site;
//        }
//        dd($a);
//        return $parents;
   }


   public function getSubcatIds($categoryId,$children = [])
   {
       $children[] = $categoryId;
       // دریافت زیرشاخه‌های این دسته‌بندی
       $parentCategories = product_cat::where('catid', $categoryId)->where('state','1')
           ->latest()
           ->select('id')
           ->get();
       foreach ($parentCategories as $category) {
           // بررسی اینکه آیا این دسته‌بندی قبلاً پردازش شده است یا خیر
           if (!in_array($category->id, $children)) {
               $children =$this->getSubcatIds($category->id,$children);
           }
       }
       // Arr::flatten => تبدیل آرایه چند بعدی به آرایه تک بعدی
       return Arr::flatten($children);
   }

   public function getProductBySubCat()
   {
       $subcategoryIds = $this->getSubcatIds($this->id);
       $products=product::whereIn('catid', $subcategoryIds)->where('state','1')->get();
       return $products;
   }
}
