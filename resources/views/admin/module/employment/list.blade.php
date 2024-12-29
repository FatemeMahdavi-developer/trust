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
                        <div class="card-header" style="display: flex;justify-content: space-between;">
                            <h4>{{$module_name}}</h4>
                            <a href="{{route('admin.employment.excel',request()->all())}}" target="_blank"> 
                                <div class="preview" style="display: inline">
                                    <div class="icon-preview" style="width:45px">
                                        <span style="color: green;font-size:10px;">Excel</span><i class="fas fa-file-excel" style="color: green"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                @slot("tabContent0")
                                    @if(isset($employments[0]))
                                        @component($prefix_component."form",['action'=>route("admin.employment.action_all")])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">نام و نام خانوادگی</th>
                                                        <th scope="col">موبایل</th>
                                                        <th scope="col">بخش</th>
                                                        <th scope="col">تایید / عدم تایید</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_employment","update_employment"])
                                                            <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($employments as $employment)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item"  value="{{$employment['id']}}"></th>
                                                            <td>{{ $loop->iteration + $employments->firstItem() - 1 }}
                                                            </td>
                                                            <td>
                                                                {{-- <div style="color:#6c757d;cursor: unset;display:inline-block;margin-left: 5px;" >
                                                                    @if($employment['hit']==1)<i class="far fa-eye"></i>@else<i class="far fa-eye-slash"></i>@endif
                                                                </div> --}}
                                                                {{$employment["name"]}}
                                                            </td>
                                                            <td>{{$employment["mobile"]}}</td>
                                                            <td>{{$employment->employment_section->name}}</td>
                                                            <td>@component($prefix_component."state_style",['id'=>$employment["id"],"column"=>'state','state'=>$employment["state"]])@endcomponent</td>
                                                            <td>{{$employment->date_convert()}}</td>
                                                            <td>
                                                                @can("update_employment")
                                                                    <a href="{{route("admin.employment.print",['id'=>$employment['id']])}}"><i class="fas fa-print" style="color: #505253;font-size: 15px;"></i></a>
                                                                    <a href="{{route("admin.employment.edit",['employment'=>$employment['id']])}}"><i class="fas fa-edit" style="color: #54ca68;font-size: 15px;"></i></a>
                                                                @endcan
                                                                @can("delete_employment")
                                                                    <a href="javascript:void(0)" data-href="{{route("admin.employment.destroy",['employment'=>$employment['id']])}}" class="delete"><i class="fas fa-trash" style="color:#fc544b;font-size: 15px;" ></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_employment")
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی
                                                        </button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit"
                                                                name="action_all" value="change_state">تفییر وضعیت
                                                        </button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$employments->links()}}
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
                                            @component($prefix_component."input",['name'=>'name','title'=>'نام و نام خانوادگی','value'=>request()->get("name"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."select",['name'=>'work_cooperate','title'=>'بخش استخدام','class'=>'w-50','items'=>$employment_section,'value_old'=>request()->get('work_cooperate')])@endcomponent
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
