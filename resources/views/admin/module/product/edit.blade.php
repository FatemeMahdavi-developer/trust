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
                            @component($prefix_component.".form",['action'=>route('admin.product.update',['product'=>$product['id']]),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."navtab",['number'=>2,'titles'=>['موارد سئو','اطلاعات کلی']])
                                        @slot("tabContent0")
                                            @include("admin.layout.common.seo",['seo_data'=>$product])
                                        @endslot
                                        @slot("tabContent1")
                                            @method("put")
                                            @component($prefix_component."input_hidden",['value'=>$product['id']])@endcomponent
                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$product['title'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."input",['name'=>'code','title'=>'کد محصول','value'=>$product['code'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'status','title'=>'وضعیت','class'=>'w-50','items'=>$status,'value_old'=>$product['status']])@endcomponent                                            
                                            @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر ','class'=>'w-50','value'=>$product['pic'],'module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>$product['alt_pic'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic_banner','title'=>'تصویر بنر ','value'=>$product['pic_banner'],'class'=>'w-50','module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic_banner','title'=>'alt تصویر بنر','value'=>$product['alt_pic_banner'],'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select_recursive",['name'=>'catid','options'=>$product_cats,'label'=>'موضوع', 'sub_method'=>'sub_cats','value'=>$product['catid'],'choose'=>true])@endcomponent
                                            @component($prefix_component."input",['name'=>'price','title'=>'قیمت','value'=>$product['price'],'class'=>'w-50 price'])@endcomponent                                        
                                            @component($prefix_component."advance_note",['name'=>'note','class'=>'my-2 ','title'=>'ویژگی','value'=>$product['note']])@endcomponent
                                            @component($prefix_component."advance_note",['name'=>'note_more','class'=>'my-2 ','title'=>'توضیحات بلند','value'=>$product['note_more']])@endcomponent
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
@section("footer")
<script>
    $(".price").val(function(index,value){return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); });
    $('.price').on('keyup',function (event) {
        $(this).val(function (index, value) { return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); });
    });
</script>
@endsection