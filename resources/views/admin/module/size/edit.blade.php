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
                            @component($prefix_component.".form",['action'=>route('admin.size.update',['size'=>$size['id']]),'method'=>'post','upload_file'=>true])
                                @slot("content")
                                    @method('put')
                                    @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$size['title'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'price','title'=>'قیمت','value'=>$size['price'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'note','title'=>'متن','value'=>$size['note'],'class'=>'w-50'])@endcomponent
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
