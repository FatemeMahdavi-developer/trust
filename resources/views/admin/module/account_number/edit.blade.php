@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "  @endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.account_number.update',['account_number'=>$account_number['id']]),'method'=>'post'])
                                @slot("content")
                                    @method('put')
                                    @component($prefix_component."input",['name'=>'name','title'=>'عنوان','value'=>$account_number['name'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'bank','title'=>'بانک','value'=>$account_number['bank'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'account_number','title'=>'شماره حساب','value'=>$account_number['account_number'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'card_number','title'=>'شماره کارت','value'=>$account_number['card_number'],'class'=>'w-50'])@endcomponent
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
