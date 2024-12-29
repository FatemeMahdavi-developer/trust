@extends("admin.layout.base")
@php $module_name= $module_title . " جدید "@endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.video.store'),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."navtab",['number'=>2,'titles'=>['موارد سئو','اطلاعات کلی']])
                                        @slot("tabContent0")
                                            @include("admin.layout.common.seo")
                                        @endslot
                                        @slot("tabContent1")
                                            @component($prefix_component."input_hidden",['name'=>'kind','value'=>2])@endcomponent
                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select_recursive",['name'=>'catid','options'=>$video_cats,'label'=>'دسته بندی','sub_method'=>'sub_cats','value'=>old('catid'),'choose'=>true])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','value'=>old('pic'),'class'=>'w-50','module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>old('alt_pic'),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'pic_banner','title'=>'تصویر بنر','value'=>old('pic_banner'),'class'=>'w-50','module'=>$module])@endcomponent
                                            @component($prefix_component."input",['name'=>'alt_pic_banner','title'=>'alt تصویر بنر','value'=>old('alt_pic_banner'),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."upload_file",['name'=>'video','title'=>'ویدیو','class'=>'w-50 video','module'=>false])@endcomponent
                                            @component($prefix_component."checkbox",['name'=>'is_aparat','value'=>old('is_aparat'),'title'=>'ویدیو آپارات','class'=>'is_aparat'])@endcomponent
                                            @component($prefix_component."advance_note",['name'=>'aparat_video','class'=>'aparat_video','title'=>'کد امبد آپارات','value'=>old('aparat_video')])@endcomponent
                                            @component($prefix_component."advance_note",['name'=>'note','title'=>'متن','value'=>old('note')])@endcomponent
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
    $(".aparat_video").addClass("d-none");
    $(".video").removeClass("d-none")
    $("#is_aparat").on("change",function(){
        if(this.checked){
            $(".video").addClass("d-none")
            $(".aparat_video").removeClass("d-none")
        }else{
            $(".aparat_video").addClass("d-none")
            $(".video").removeClass("d-none")
        }
    });
</script>
@if(!empty(old("is_aparat")))
<script>
    $(document).ready(function () {
        if("{{old("is_aparat")}}" == "1"){
            $(".video").addClass("d-none")
            $(".aparat_video").removeClass("d-none")
        }else{
            $(".aparat_video").addClass("d-none")
            $(".video").removeClass("d-none")
        }
    })
</script>
@endif


@endsection