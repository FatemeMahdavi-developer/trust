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
                            @component($prefix_component.".form",['action'=>route('admin.photo.store'),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input_hidden",['name'=>'kind','value'=>1])@endcomponent
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','class'=>'w-50','module'=>$module])@endcomponent
                                    @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>old('alt_pic'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select_recursive",['name'=>'catid','options'=>$photo_cats,'label'=>'موضوع', 'sub_method'=>'sub_cats','value'=>old('catid'),'choose'=>true])@endcomponent
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