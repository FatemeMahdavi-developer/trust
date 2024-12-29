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
                        <div class="card-header d-flex justify-content-between  ">
                            <h4>{{$module_name}}</h4>
                            @can("read_content")
                                <a href="{{route("admin.content.list",['item_id'=>$content["contentable_id"],'module'=>$module_type])}}" class="btn btn-primary btn-sm">لیست محتوا</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.content.update',['item_id'=>$item_id,'module'=>$module_type]),'upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input_hidden",['name'=>"kind",'value'=>$content["kind"]])@endcomponent
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$content["title"],'class'=>'w-50'])@endcomponent
                                    @if($content["kind"]==1 || $content["kind"]==6)
                                    @component($prefix_component."textarea",['name'=>'note','class'=>'kind_item kind_1 kind_6','title'=>'متن','value'=>$content["note"]])@endcomponent
                                    @endif
                                    @if($content["kind"]==2)
                                    @component($prefix_component."upload_file",['name'=>'pic','value'=>$content["pic"],'title'=>'تصویر','class'=>'w-50 kind_item kind_2','module'=>$module."_".$module_type])@endcomponent
                                    @endif
                                    @if($content["kind"]==3)
                                    @component($prefix_component."upload_file",['name'=>'pics','value'=>$content["pic"],'title'=>'تصویر چندتایی','class'=>'w-50 kind_item kind_3','module'=>$module."_".$module_type])@endcomponent
                                    @endif
                                    @if($content["kind"]==4)
                                    @component($prefix_component."upload_file",['name'=>'catalog','value'=>$content["catalog"],'title'=>'کاتالوگ','class'=>'w-50 kind_item kind_4','module'=>false])@endcomponent
                                    @endif
                                    @if($content["kind"]==5)
                                    @component($prefix_component."upload_file",['name'=>'pic_video','value'=>$content["pic_video"],'title'=>'کاور ویدیو','class'=>'w-50 kind_item kind_5 video','module'=>false])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'video','value'=>$content["video"],'title'=>'ویدیو','class'=>'w-50 kind_item kind_5 video','module'=>false])@endcomponent
                                    @component($prefix_component."checkbox",['name'=>'is_aparat','value'=>$content["is_aparat"],'title'=>'کد امبد آپارات','class'=>'kind_item kind_5 my-3 '])@endcomponent
                                    @endif
                                    @if($content['kind']==7)
                                    @component($prefix_component."advance_note",['name'=>'note_more','class'=>'my-2 kind_item kind_7 aparat','title'=>'متن','value'=>$content["note_more"]])@endcomponent
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
        $("[name='is_aparat']").on('change', function () {
            $(".video").removeClass("d-none d-block")
            $(".aparat").removeClass("d-none d-block")
            if (this.checked) {
                $(".video").addClass("d-none")
                $(".aparat").addClass("d-block")
            } else {
                $(".video").addClass("d-block")
                $(".aparat").addClass("d-none")
            }
        })
    </script>
    @if(!empty($content["is_aparat"]))
        <script>
            $(document).ready(function () {
                $(".video").removeClass("d-none d-block")
                $(".aparat").removeClass("d-none d-block")

                if ("{{$content["is_aparat"]}}" == "1") {
                    $(".video").addClass("d-none")
                    $(".aparat").addClass("d-block")
                } else {
                    $(".video").addClass("d-block")
                    $(".aparat").addClass("d-none")
                }
            })
        </script>
    @endif
    @if(!empty($content["kind"]))
        <script>
            var kind = "{{$content["kind"]}}"
            $(".kind_" + kind).removeClass("d-none")
        </script>
    @endif
    @foreach(__("common.content." . $module_type) as $key => $value)
        @if($key != $content["kind"])
            <script>
                if (!$(".kind_{{$key}}").hasClass("kind_" + "{{$content["kind"]}}")) {
                    if ("{{$content["kind"]}}" == "5") {
                        !$(".kind_{{$key}}").hasClass("aparat") ?? $(".kind_{{$key}}").remove()
                    } else {
                        $(".kind_{{$key}}").remove()
                    }
                }
            </script>
        @endif
    @endforeach
@endsection
