<?php

namespace App\Trait;
trait seo_site
{
    public function seo_site($module,$item=[]){
        $seo=[];
        $seo["seo_title"]=$item["seo_title"] ?? app('setting')[$module."_title"] ?? trans('modules.module_name_site.'.$module);
        $seo["seo_keyword"]=$item["seo_keyword"] ?? app('setting')[$module."_keyword"];
        $seo["seo_description"]=$item["seo_description"] ?? app('setting')[$module."_description"];
        $seo["seo_canonical"]=$item["seo_canonical"] ?? urldecode(request()->url());
        $seo["seo_index_kind"]=!empty($item["seo_index_kind"]) ? trans("common.robots.".$item["seo_index_kind"])  : "index, follow";
        return $seo;
    }
}
