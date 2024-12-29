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
                                    @if(isset($users[0]))
                                        @component($prefix_component."form",['action'=>route("admin.user.action_all")])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">نام و نام خانوادگی</th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">ایمیل</th>
                                                        <th scope="col">تاریخ عضویت</th>
                                                        @canany(["delete_user","update_user"])
                                                            <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item" value="{{$user['id']}}"></th>
                                                            <td>{{ $loop->iteration + $users->firstItem() - 1 }}
                                                            <td>{{ $user["name"] . " ". $user["lastname"] }}</td>
                                                            <td>@component($prefix_component."state_style",['id'=>$user["id"],"column"=>'state','state'=>$user["state"]])@endcomponent</td>
                                                            <td>{{ $user["username"] }}</td>
                                                            <td>{{ $user->date_convert() }}</td>
                                                            <td>
                                                                @can("update_user")
                                                                <a href="{{route("admin.user.edit",['user'=>$user['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_user")
                                                                <a href="javascript:void(0)" data-href="{{route("admin.user.destroy",['user'=>$user['id']])}}" class="btn btn-danger btn-sm delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_user")
                                                            <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی </button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$users->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @else
                                        <div class="alert alert-danger">{{__('common.messages.result_not_found')}}</div>
                                    @endif
                                @endslot
                                @slot("tabContent1")
                                    @component($prefix_component."form",['method'=>'get'])
                                        @slot("content")
                                            @component($prefix_component."input",['name'=>'name','title'=>'نام','value'=>request()->get("name"),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'gender','title'=>'جنسیت','class'=>'w-50','items'=>trans("common.gender"),'value_old'=>request()->get('gender')])@endcomponent
                                            @component($prefix_component."input",['name'=>'username','title'=>'ایمیل','value'=>request()->get("username"),'class'=>'w-50'])@endcomponent
{{--                                            @component($prefix_component."input",['name'=>'tell','title'=>'تلفن','value'=>request()->get("tell"),'class'=>'w-50'])@endcomponent--}}
                                            @component($prefix_component."select",['name'=>'state','title'=>'وضعیت','class'=>'w-50','items'=>trans("common.state_user"),'value_old'=>request()->get('state')])@endcomponent
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
