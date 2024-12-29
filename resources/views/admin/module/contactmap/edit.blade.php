@extends("admin.layout.base")
@php $module_name= " ویرایش ". $module_title @endphp
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
                            @component($prefix_component.".form",['action'=>route('admin.contactmap.update',),'method'=>'post'])
                            @slot("content")
                            @method('put')
                                <div id="map" style="height:500px"></div>
                                @component($prefix_component."input",['name'=>'lgmap','title'=>'طول جغرافیایی','value'=>$contactmap['lgmap'],'class'=>'w-50 lgmap'])@endcomponent
                                @component($prefix_component."input",['name'=>'qgmap','title'=>'عرض جغرافیایی','value'=>$contactmap['qgmap'],'class'=>'w-50 qgmap'])@endcomponent
                                @component($prefix_component."input",['name'=>'zgmap','title'=>'بزرگ نمایی','value'=>$contactmap['zgmap'],'class'=>'w-50'])@endcomponent
                                @component($prefix_component."advance_note",['name'=>'cgmap','class'=>'my-2 ','title'=>'توضیحات','value'=>$contactmap['cgmap']])@endcomponent
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
