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
                            @if(isset($employment_section[0]))
                                @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                    @slot("tabContent0")
                                        @component($prefix_component."form",['action'=>route("admin.employment_section.action_all")])
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
                                                        @canany(["delete_employment_section","update_employment_section"])
                                                        <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($employment_section as $post)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item" value="{{$post['id']}}"></th>
                                                            <td>{{ $loop->iteration + $employment_section->firstItem() - 1 }}</td>
                                                            <td>{{$post["name"]}}</td>
                                                            <td>@component($prefix_component."state_style",['id'=>$post["id"],"column"=>'state','state'=>$post["state"]])@endcomponent</td>
                                                            <td><input type="text" value="{{$post["order"]}}" class="input-order" name="order[{{$post['id']}}]"></td>
                                                            <td>{{$post->date_convert()}}</td>
                                                            <td>
                                                                @can("update_employment_section")
                                                                <a href="{{route("admin.employment_section.edit",['employment_section'=>$post['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_employment_section")
                                                                <a href="javascript:void(0)" data-href="{{route("admin.employment_section.destroy",['employment_section'=>$post['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">  
                                                        @can("delete_employment_section")
                                                            <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$employment_section->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot

                                    @slot("tabContent1")
                                        @component($prefix_component."form",['method'=>'get'])
                                            @slot("content")

                                                @component($prefix_component."input",['name'=>'name','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
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
