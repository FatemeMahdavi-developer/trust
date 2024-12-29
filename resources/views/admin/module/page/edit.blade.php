@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "  @endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.page.update',["page"=>$page["id"]]),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @method("put")
                                    @component($prefix_component."navtab",['number'=>2,'titles'=>['موارد سئو','اطلاعات کلی']])
                                        @slot("tabContent0")
                                            @include("admin.layout.common.seo",['seo_data'=>$page])
                                        @endslot
                                        @slot("tabContent1")
                                            @component($prefix_component."input_hidden",['value'=>$page['id']])@endcomponent
                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$page["title"],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'kind','title'=>'نوع','class'=>'w-50','items'=>trans("common.kind"),'value_old'=>$page["kind"]])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','value'=>$page["pic"],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>$page["alt_pic"],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."advance_note",['name'=>'note','class'=>'my-2 ','title'=>'توضیحات بلند','value'=>$page['note']])@endcomponent

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

