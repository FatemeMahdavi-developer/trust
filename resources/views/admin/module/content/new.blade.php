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
                        <div class="card-header d-flex justify-content-between  ">
                            <h4>{{$module_name}}</h4>
                            @can("read_content")
                                <a href="{{route("admin.content.list",['item_id'=>$item_id,'module'=>$module_type])}}" class="btn btn-primary btn-sm">لیست محتوا</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.content.store',['item_id'=>$item_id,'module'=>$module_type]),'upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'kind','title'=>'نوع','class'=>'w-50','items'=>$content_kind,'value_old'=>old('kind')])@endcomponent
                                    @if(@$content_kind[1] || @$content_kind[6])
                                    @component($prefix_component."textarea",['name'=>'note','class'=>'kind_item kind_1 kind_6','title'=>'متن','value'=>old('note')])@endcomponent
                                    @endif
                                    @if(@$content_kind[2])
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','class'=>'w-50 kind_item kind_2','module'=>$module."_".$module_type])@endcomponent
                                    @endif
                                    @if(@$content_kind[3])
                                    @component($prefix_component."upload_multiple",['name'=>'pics','title'=>'تصویر چند تایی','class'=>'w-50 kind_item kind_3','module'=>$module."_".$module_type])@endcomponent
                                    @endif
                                    @if(@$content_kind[4])
                                    @component($prefix_component."upload_file",['name'=>'catalog','title'=>'کاتالوگ','class'=>'w-50 kind_item kind_4','module'=>false])@endcomponent
                                    @endif
                                    @if(@$content_kind[5])
                                    @component($prefix_component."upload_file",['name'=>'pic_video','title'=>'کاور ویدیو','class'=>'w-50 kind_item kind_5 video','module'=>false])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'video','title'=>'ویدیو','class'=>'w-50 kind_item kind_5 video','module'=>false])@endcomponent
                                    @component($prefix_component."checkbox",['name'=>'is_aparat','value'=>old('is_aparat'),'title'=>'کد امبد آپارات','class'=>'kind_item kind_5 my-3 '])@endcomponent
                                    @endif
                                    @if(@$content_kind[7])
                                    @component($prefix_component."advance_note",['name'=>'note_more','class'=>'my-2 kind_item kind_7 aparat','title'=>'متن','value'=>old('note_more')])@endcomponent
                                    @endif
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
        $(".kind_item").addClass("d-none")
        $("[name='kind']").on('change', function () {
            var kind = $(this).val()
            $(".kind_item").addClass("d-none")
            $(".kind_" + kind).removeClass("d-none")
        })

        $("[name='is_aparat']").on('change',function () {
            $(".video").removeClass("d-none d-block")
            $(".aparat").removeClass("d-none d-block")
            if(this.checked){
                $(".video").addClass("d-none")
                $(".aparat").addClass("d-block")
            }
            else{
                $(".video").addClass("d-block")
                $(".aparat").addClass("d-none")
            }
        })
    </script>
    @if(!empty(old("is_aparat")))
        <script>
            $(document).ready(function () {
                $(".video").removeClass("d-none d-block")
                $(".aparat").removeClass("d-none d-block")
                if("{{old("is_aparat")}}" == "1"){
                    $(".video").addClass("d-none")
                    $(".aparat").addClass("d-block")
                }
                else{
                    $(".video").addClass("d-block")
                    $(".aparat").addClass("d-none")
                }
            })
        </script>
    @endif
    @if(!empty(old("kind")))
        <script>
            var kind = $("[name='kind']").val()
            $(".kind_" + kind).removeClass("d-none")
        </script>
    @endif
@endsection
