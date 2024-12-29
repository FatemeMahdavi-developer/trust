@extends("admin.layout.base")
@php $module_name="ویرایش " . $module_title @endphp
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
                @component($prefix_component.".form",['action'=>route('admin.product_cat.update',['product_cat'=>$product_cat['id']]),'method'=>'post','upload_file'=>true])
                    @slot("content")
                        @component($prefix_component."navtab",['number'=>2,'titles'=>['موارد سئو','اطلاعات کلی']])
                            @slot("tabContent0")
                                @include("admin.layout.common.seo",['seo_data'=>$product_cat])
                            @endslot
                            @slot("tabContent1")
                                @method("put")
                                @component($prefix_component."input_hidden",['value'=>$product_cat['id']])@endcomponent
                                @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$product_cat["title"],'class'=>'w-50'])@endcomponent
                                @component($prefix_component."select_recursive",['name'=>'catid','options'=>$product_cats,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats','value'=>$product_cat["catid"]])@endcomponent
                                @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','value'=>$product_cat['pic'],'class'=>'w-50','module'=>$module])@endcomponent
                                @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>$product_cat["alt_pic"],'class'=>'w-50'])@endcomponent
                                @component($prefix_component."upload_file",['name'=>'pic_banner','title'=>'تصویر بنر','value'=>$product_cat['pic_banner'],'class'=>'w-50','module'=>$module])@endcomponent
                                @component($prefix_component."input",['name'=>'alt_pic_banner','title'=>'alt تصویر بنر','value'=>$product_cat["alt_pic_banner"],'class'=>'w-50'])@endcomponent
                                @component($prefix_component."advance_note",['name'=>'note','class'=>'my-2 ','title'=>'متن','value'=>$product_cat['note']])@endcomponent
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

