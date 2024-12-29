@component($prefix_component."input",['name'=>'seo_title','title'=>'عنوان سئو','class'=>'w-50','value'=>$seo_data['seo_title'] ?? old('seo_title')])@endcomponent
@component($prefix_component."input",['name'=>'seo_url','title'=>'آدرس سئو','class'=>'w-50','value'=> $seo_data['seo_url'] ?? old('seo_url')])@endcomponent
@component($prefix_component."input",['name'=>'seo_h1','title'=>'عنوان تگ H1','class'=>'w-50','value'=>$seo_data['seo_h1'] ?? old('seo_h1')])@endcomponent
@component($prefix_component."input",['name'=>'seo_canonical','title'=>'کنونیکال','class'=>'w-50','value'=>$seo_data['seo_canonical'] ?? old('seo_canonical'),'dir'=>'ltr'])@endcomponent
@component($prefix_component."input",['name'=>'seo_redirect','title'=>'ریدایرکت','class'=>'w-50','value'=>$seo_data['seo_redirect'] ?? old('seo_redirect'),'dir'=>'ltr'])@endcomponent
@component($prefix_component."select",['name'=>'seo_redirect_kind','title'=>'نوع ریدایرکت','class'=>'w-50','items'=>__('common.redirect_kinds'),'value_old'=>$seo_data['seo_redirect_kind'] ?? old('seo_redirect_kind')])@endcomponent
@component($prefix_component."select",['name'=>'seo_index_kind','title'=>'ایندکس','class'=>'w-50','items'=>__('common.robots'),'value_old'=>$seo_data['seo_index_kind'] ?? old('seo_index_kind')])@endcomponent
@component($prefix_component."tagsinput",['name'=>'seo_keyword','title'=>'کلمات کلیدی','class'=>'w-50','value'=>$seo_data['seo_keyword'] ?? old('seo_keyword')])@endcomponent
@component($prefix_component."textarea",['name'=>'seo_description','title'=>'توضیحات سئو','value'=>$seo_data['seo_description'] ?? old('seo_description')])@endcomponent
