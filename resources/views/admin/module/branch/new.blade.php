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
                            @component($prefix_component."form",['action'=>route('admin.branch.store'),'upload_file'=>true])
                                @slot("content")
                                    <div id="map" style="height:500px"></div>
                                    @component($prefix_component."input",['name'=>'lgmap','title'=>'طول جغرافیایی','value'=>old('lgmap'),'class'=>'w-50 lgmap'])@endcomponent
                                    @component($prefix_component."input",['name'=>'qgmap','title'=>'عرض جغرافیایی','value'=>old('qgmap'),'class'=>'w-50 qgmap'])@endcomponent
                                    @component($prefix_component."input",['name'=>'name','title'=>'عنوان','value'=>old('name'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'code','title'=>'کد شعبه','value'=>old('code'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."input",['name'=>'postal_code','title'=>'کد پستی','value'=>old('postal_code'),'class'=>'w-50'])@endcomponent
                                    @component($prefix_component."textarea",['name'=>'address','class'=>'my-2 ','title'=>'آدرس','value'=>old("address")])@endcomponent
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
        location_map("{{$contactmap['qgmap']}}","{{$contactmap['lgmap']}}",'{!!$contactmap["cgmap"]!!}',"{{$contactmap['zgmap']}}");
    </script>
@endsection
