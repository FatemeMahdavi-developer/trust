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
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.instagram.store'),'upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."upload_file",['name'=>'pic','title'=>'تصویر','value'=>old('pic'),'class'=>'w-50','module'=>$module])@endcomponent
                                    @component($prefix_component."input",['name'=>'alt_pic','title'=>'alt تصویر','value'=>old('alt_pic'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'link','title'=>'لینک','value'=>old('link'),'class'=>'w-50'])@endcomponent
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
