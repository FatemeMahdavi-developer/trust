@extends("admin.layout.base")
@php $module_name="لیست " . $module_title @endphp
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
            @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                @slot("tabContent0")
                    @component($prefix_component."form",['action'=>route("admin.size.action_all")])
                        @slot("content")
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="check_all"></th>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">ترتیب</th>
                                    <th scope="col">تاریخ</th>
                                    @canany(["delete_size","update_size"])
                                        <th scope="col">عملیات</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($sizes[0]))
                                        @foreach($sizes as $size)
                                            <tr>
                                                <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item"  value="{{$size['id']}}"></th>
                                                <td>{{ $loop->iteration + $sizes->firstItem() - 1 }}
                                                </td>
                                                <td>{{$size["title"]}}</td>
                                                <td>@component($prefix_component."state_style",['id'=>$size["id"],"column"=>'state','state'=>$size["state"]])@endcomponent</td>
                                                <td><input type="text" value="{{$size["order"]}}" class="input-order" name="order[{{$size['id']}}]"></td>
                                                <td>{{$size->date_convert()}}</td>
                                                <td>
                                                    @can("update_size")
                                                    <a href="{{route("admin.size.edit",['size'=>$size['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can("delete_size")
                                                    <a href="javascript:void(0)" data-href="{{route("admin.size.destroy",['size'=>$size['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="alert alert-danger">{{__('common.messages.result_not_found')}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-5">
                                    @can("delete_size")
                                    <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                    @endcan
                                    <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت </button>
                                    <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                </div>
                                <div class="col-7 d-flex justify-content-end">
                                    {{$sizes->links()}}
                                </div>
                            </div>
                        @endslot
                    @endcomponent
                @endslot
                @slot("tabContent1")
                    @component($prefix_component."form",['method'=>'get'])
                        @slot("content")
                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
                            <div class="my-3">
                                @component($prefix_component."button",['title'=>'جستجو'])@endcomponent
                            </div>
                        @endslot
                    @endcomponent
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
