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
                            @component($prefix_component.".form",['action'=>route('admin.box.store'),'method'=>'post'])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>old('title'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'number_box','title'=>'شماره کمد','value'=>old('number_box'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'state','title'=>'وضعیت','class'=>'w-50','items'=>$state,'value_old'=>old('state')])@endcomponent
                                    @component($prefix_component."select",['name'=>'locker_bank_id','title'=>'دسته بندی','class'=>'w-50','items'=>$lockerBanks,'value_old'=>old('locker_bank_id'),'key'=>'id','value'=>'full_name'])@endcomponent
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
