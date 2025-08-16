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
                            @component($prefix_component."form",['action'=>route("admin.locker-bank.update",['locker_bank'=>$lockerBank['id']])])
                                @slot("content")
                                    @method('put')
                                    @component($prefix_component."input",['name'=>'code','title'=>' کد','value'=>$lockerBank['code'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."select",['name'=>'branch_id','title'=>'شعبه','key'=>'id','value'=>'name','class'=>'w-50','items'=>$branches,'value_old'=>$lockerBank['branch_id']])@endcomponent
                                    @component($prefix_component."select",['name'=>'size','title'=>'سایز','class'=>'w-50','items'=>$size,'value_old'=>$lockerBank['size']])@endcomponent
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


\\
