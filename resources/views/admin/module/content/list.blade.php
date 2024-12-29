@extends("admin.layout.base")
@php $module_name="  لیست   " . __("modules.module_name")[$module_type] . " ({$model['title']}) " @endphp
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
                            @can("create_content")
                                <a href="{{route("admin.content.create",['item_id'=>$item_id,'module'=>$module_type])}}" class="btn btn-primary btn-sm">محتوای جدید</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            @if(isset($content[0]))
                                @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                    @slot("tabContent0")
                                        @component($prefix_component."form",['action'=>route('admin.content.action_all',['item_id'=>$item_id,'module'=>$module_type])])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">مدیر</th>
                                                        <th scope="col">نوع</th>
                                                        <th scope="col">ترتیب</th>
                                                        <th scope="col">وضعیت نمایش</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_content","update_content"])
                                                            <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($content as $item)
                                                        <tr>
                                                            <td><input type="checkbox" class="checkbox_item" name="item[]" value="{{$item['id']}}"></td>
                                                            <td>{{ $loop->iteration + $content->firstItem() - 1 }}
                                                            <td>{{ $item['title'] }}</td>
                                                            <td>مدیر اصلی</td>
                                                            <td>{{ __("common.content.".$module_type)[$item["kind"]] ?? "-" }}</td>
                                                            <td><input type="text" value="{{$item["order"]}}" class="input-order" name="order[{{$item['id']}}]"></td>
                                                            <td>
                                                                @component($prefix_component."state_style",['id'=>$item["id"],"column"=>'state','state'=>$item["state"]])@endcomponent
                                                            </td>
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_content")
                                                                    <a href="{{route("admin.content.edit",['item_id'=>$item["id"],'module'=>$module_type])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_content")
                                                                    <a href="javascript:void(0)" data-href="{{route('admin.content.destroy',['item_id'=>$item["id"],'module'=>$module_type])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        <tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_content")
                                                            <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$content->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot

                                    @slot("tabContent1")
                                        @component($prefix_component."form",['method'=>'get'])
                                            @slot("content")
                                                @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."select",['name'=>'kind','title'=>'نوع','class'=>'w-50','items'=>$content_kind,'value_old'=>request()->get('kind')])@endcomponent

                                                <div class="my-3">
                                                    @component($prefix_component."button",['title'=>'جستجو'])@endcomponent
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot
                                @endcomponent
                            @else
                                <div
                                    class="alert alert-danger">{{__('common.messages.result_not_found')}}</div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
