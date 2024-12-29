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
                            @if(isset($manager[0]))
                                @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                    @slot("tabContent0")
                                        @component($prefix_component."form",['action'=>route('admin.manager.action_all')])
                                            @slot("content")

                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">نام و نام خانوادگی</th>
                                                        <th scope="col">ایمیل</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_manager","update_manager"])
                                                        <th scope="col">عملیات</th>
                                                    @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($manager as $item)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" class="checkbox_item"  name="item[]" value="{{$item['id']}}"></th>
                                                            <td>{{ $loop->iteration + $manager->firstItem() - 1 }}
                                                            <td>{{$item["fullname"]}}</td>
                                                            <td>{{$item["email"]}}</td>
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_manager")
                                                                <a href="{{route("admin.manager.edit",['manager'=>$item['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_manager")
                                                                    <a href="javascript:void(0)" data-href="{{route("admin.manager.destroy",['manager'=>$item['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_manager")
                                                            <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$manager->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot

                                    @slot("tabContent1")
                                        @component($prefix_component."form",['method'=>'get'])
                                            @slot("content")
                                                @component($prefix_component."input",['name'=>'fullname','title'=>'نام و نام خانوادگی','value'=>request()->get("fullname"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."input",['name'=>'mobile','title'=>'موبایل','value'=>request()->get("mobile"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."input",['name'=>'email','title'=>'ایمیل','value'=>request()->get("email"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."input",['name'=>'username','title'=>'نام کاربری','value'=>request()->get("username"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."select",['name'=>'role_id','title'=>'سطح دسترسی','class'=>'w-50','items'=>$roles,'value_old'=>request()->get('role_id'),'key'=>'id','value'=>'title'])@endcomponent
                                                <div class="my-3">
                                                    @component($prefix_component."button",['title'=>'جستجو'])@endcomponent
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot
                                @endcomponent
                            @else
                                <div class="alert alert-danger">{{__('common.messages.result_not_found')}}</div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

