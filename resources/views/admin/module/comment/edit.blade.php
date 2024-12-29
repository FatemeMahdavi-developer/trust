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
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{$module_name}}</h4>
                        </div>
                        <div class="card-body">
                            @component($prefix_component."table",['column'=>['fullname'=>'نام و نام خانوادگی','created_at_show'=>'تاریخ','ip_address'=>'آی پی','note'=>'متن'],'item'=>$comment])@endcomponent
                            @component($prefix_component."form",['action'=>route('admin.comment.update',["comment"=>$comment["id"]]),'upload_file'=>true])
                                @slot("content")
                                    @method('put')
                                    @component($prefix_component."advance_note",['name'=>'response_note','class'=>'my-2 ','title'=>'پاسخ','value'=>$comment['response_note'] ?? ''])@endcomponent
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
@section("footer")

@endsection
