@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "@endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$module_name}}</h4>
                        </div>
                        <div class="card-body">
                            @component($prefix_component.".form",['action'=>route('admin.news.update',['news'=>$news['id']]),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."navtab",['number'=>2,'titles'=>['موارد سئو','اطلاعات کلی']])
                                        @slot("tabContent0")
                                            @include("admin.layout.common.seo",['seo_data'=>$news])
                                        @endslot
                                        @slot("tabContent1")
                                            @method("put")
                                            @component($prefix_component."input_hidden",['value'=>$news['id']])@endcomponent
                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$news['title'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."datepicker",['name'=>'validity_date','title'=>'تاریخ نمایش','value'=>$news['validate_date_admin'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر ','class'=>'w-50','value'=>$news['pic'],'module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>$news['alt_pic'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic_banner','title'=>'تصویر بنر ','value'=>$news['pic_banner'],'class'=>'w-50','module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic_banner','title'=>'alt تصویر بنر','value'=>$news['alt_pic_banner'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select_recursive",['name'=>'catid','options'=>$news_cats,'label'=>'موضوع', 'sub_method'=>'sub_cats','value'=>$news['catid'],'choose'=>true])@endcomponent
                                            @component($prefix_component."textarea",['name'=>'note','class'=>'my-2 ','title'=>'توضیحات کوتاه','value'=>$news['note']])@endcomponent
                                            @component($prefix_component."advance_note",['name'=>'note_more','class'=>'my-2 ','title'=>'توضیحات بلند','value'=>$news['note_more']])@endcomponent
                                        @endslot
                                    @endcomponent
                                    @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                @endslot
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

