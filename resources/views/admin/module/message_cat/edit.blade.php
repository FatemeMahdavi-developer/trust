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
                @component($prefix_component."form",['action'=>route('admin.message_cat.update',["message_cat"=>$message_cat["id"]])])
                    @slot("content")
                        @method("put")
                        @component($prefix_component."input_hidden",['value'=>$message_cat['id']])@endcomponent
                        @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$message_cat["title"],'class'=>'w-50'])@endcomponent
                        @component($prefix_component."input",['name'=>'email','title'=>'ایمیل','value'=>$message_cat["email"],'class'=>'w-50'])@endcomponent
                        @component($prefix_component."select_recursive",['name'=>'catid','options'=>$message_cats,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats','value'=>$message_cat["catid"]])@endcomponent
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

