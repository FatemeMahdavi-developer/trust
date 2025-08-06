@extends("admin.layout.base")
@php $module_name= $module_title . " ویرایش "@endphp
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
                            @component($prefix_component."form",['action'=>route('admin.branch.update',['branch'=>$branch['id']]),'upload_file'=>true])
                                @slot("content")
                                    @method('put')
                                    <div id="map" style="height:500px"></div>
                                    @component($prefix_component."input",['name'=>'lgmap','title'=>'طول جغرافیایی','value'=>$branch['lgmap'],'class'=>'w-50 lgmap'])@endcomponent
                                    @component($prefix_component."input",['name'=>'qgmap','title'=>'عرض جغرافیایی','value'=>$branch['qgmap'],'class'=>'w-50 qgmap'])@endcomponent
                                    @component($prefix_component."input",['name'=>'name','title'=>'عنوان','value'=>$branch['name'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'code','title'=>'کد شعبه','value'=>$branch['code'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'postal_code','title'=>'کد پستی','value'=>$branch['postal_code'],'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."textarea",['name'=>'address','title'=>'آدرس','value'=>$branch['address'],'class'=>'w-50'])@endcomponent
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
    <script>
        location_map("{{$branch['qgmap']}}","{{$branch['lgmap']}}",'{!!$branch["name"]!!}',"15");
    </script>
@endsection
