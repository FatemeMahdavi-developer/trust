@extends("admin.layout.base")
@php $module_name= $module_title . " جدید "  @endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.menu.store'),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."checkbox",['name'=>'select_page','title'=>'انتخاب صفحه','class'=>'w-50','value'=>old("select_page")])@endcomponent
                                    @component($prefix_component."input",['name'=>'url','title'=>'آدرس صفحه','value'=>old('url'),'class'=>'w-50 url','dir'=>'ltr'])@endcomponent
                                    @component($prefix_component."select",['name'=>'pages','title'=>'آدرس صفحه','class'=>'w-50 pages','items'=>$pages_url,'value_old'=>old('pages')])@endcomponent
                                    @component($prefix_component."select",['name'=>'type','title'=>'نوع','class'=>'w-50 typetype','items'=>$menu_kind,'value_old'=>old('type')])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','class'=>'w-50 type type-1','module'=>$module])@endcomponent
                                    @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>old('alt_pic'),'class'=>'w-50 type type-1'])@endcomponent
                                    @component($prefix_component."select",['name'=>'open_type','title'=>'نوع باز شدن','class'=>'w-50','items'=>$open_type,'value_old'=>old('open_type')])@endcomponent
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
    var catid="";
</script>
@if(old('catid'))
<script>
     catid={{old('catid')}};
</script>
@endif

<script>
    $(".type").addClass("d-none")
    $("[name='type']").on('change', function () {
        var type=$(this).val()
        $(".type").removeClass('d-block').addClass("d-none")
        $(".type-"+type).removeClass('d-none').addClass("d-block")
        $.ajax({
            url: "{{route("admin.menu.submenu")}}",
            method: "post",
            data: {
                '_token': $("input[name='_token']").val(),
                'type': type,
                'catid':catid,
            },
            success: function (result) {
                $(".show_catid").remove();
                $("[name='type']").parent().after(result);
                $("#catid").select2({
                    placeholder: "انتخاب کنید",
                    theme: "default",
                    dir: "rtl",
                    language: "fa"
                })
            },
            error: function () {
                toaste("error", "خطا در برقراری ارتباط")
            }
        })
    }).trigger("change");
    $(".pages").addClass("d-none")
    $('#select_page').change(function () {
        if($(this).is(":checked")){
            $(".pages").removeClass('d-none').addClass("d-block")
            $(".url").addClass('d-none').removeClass("d-block")
        }else{
            $(".pages").addClass("d-none").removeClass("d-block")
            $(".url").addClass("d-block").removeClass("d-none")
        }
    }).trigger("change")

</script>
@if(old('type'))
<script>
    var show_class=".type-"+{{old('type')}};
    $(show_class).addClass("d-block");
</script>
@endif
@endsection
