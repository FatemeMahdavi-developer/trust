@extends("admin.layout.base")
@php $module_name=  " ویرایش " . $module_title @endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.box.update',['box'=>$box['id']]),'method'=>'post'])
                                @slot("content")
                                    @method("put")
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$box['title'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'number_box','title'=>'کد محصول','value'=>$box['number_box'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'state','title'=>'وضعیت','class'=>'w-50','items'=>$state,'value_old'=>$box['state']])@endcomponent
                                    @component($prefix_component."select_recursive",['name'=>'size_id','options'=>$sizes,'label'=>'سایز','value'=>$box['size_id'],'choose'=>true])@endcomponent
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
