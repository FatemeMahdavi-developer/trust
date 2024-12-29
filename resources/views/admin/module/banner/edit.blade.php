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
                            @component($prefix_component.".form",['action'=>route('admin.banner.update',['banner'=>$banner['id']]),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @method('put')
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$banner['title'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'type','title'=>'نوع','class'=>'w-50','items'=>$banner_kind,'value_old'=>$banner['type']])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر ','value'=>$banner['pic'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>$banner['alt_pic'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic_mobile','title'=>'تصویر موبایل'.getMaxSize("banner_type_1",'pic_mobile'),'value'=>$banner['pic_mobile'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'open_type','title'=>'نوع باز شدن','class'=>'w-50','items'=>$open_type,'value_old'=>$banner['open_type']])@endcomponent
                                    @component($prefix_component."input",['name'=>'address','title'=>'آدرس','value'=>$banner['address'],'class'=>'w-50'])@endcomponent
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

        // $("[name='type']").on('change', function () {
        //     $("[for='pic']").parent().find("[type='text']").remove()
        //     if($(this.val() == "1")){
        //
        //     }
        // })
    </script>
@endsection
