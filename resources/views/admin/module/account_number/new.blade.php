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
                            @component($prefix_component.".form",['action'=>route('admin.account_number.store'),'method'=>'post'])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'name','title'=>'نام و نام خانوادگی','value'=>old('name'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'bank','title'=>'بانک','value'=>old('bank'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'account_number','title'=>'شماره حساب','value'=>old('account_number'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'card_number','title'=>'شماره کارت','value'=>old('card_number'),'class'=>'w-50'])@endcomponent
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
