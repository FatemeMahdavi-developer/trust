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
                            @component($prefix_component.".form",['action'=>route('admin.permission.store'),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'name','title'=>'عنوان','value'=>old('name'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."checkbox",['name'=>'check_all','title'=>'انتخاب همه', 'value'=>old('check_all') ,'class'=>'my-3'])@endcomponent
                                    @component($prefix_component."select2_multiple",['name'=>'access','title'=>'سطح دسترسی','items'=>$modules,'class'=>'w-50','value_old'=>old('access')])@endcomponent
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

