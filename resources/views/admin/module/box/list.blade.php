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
                                    @if(isset($box[0]))
                                        @component($prefix_component."form",['action'=>route('admin.box.action_all')])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">مدیر</th>
                                                        <th scope="col"> سایز </th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">ترتیب</th>
                                                        {{-- <th scope="col">نمایش در صفحه اصلی</th> --}}
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_box","update_box"])
                                                        <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($box as $item)

                                                        <tr>
                                                            <th scope="row"><input type="checkbox" class="checkbox_item"  name="item[]" value="{{$item['id']}}"></th>
                                                            <td>{{ $loop->iteration + $box->firstItem() - 1 }}
                                                            <td>{{$item["title"]}}</td>
                                                            <td>{{$item->admin->fullname}}</td>
                                                            <td>{{$sizes[$item->lockerBank->size->value]}}</td>
                                                            <td>{{$state[$item->state->value]}}</td>
                                                            <td><input type="text" value="{{$item["order"]}}" class="input-order" name="order[{{$item['id']}}]"></td>
                                                            {{-- <td>
                                                                @component($prefix_component."state_style",['id'=>$item["id"],"column"=>'state_main','state'=>$item["state_main"]])@endcomponent
                                                            </td> --}}
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_box")
                                                                <a href="{{route("admin.box.edit",['box'=>$item['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_box")
                                                                <a href="javascript:void(0)" data-href="{{route("admin.box.destroy",['box'=>$item['id']])}}" class="btn btn-danger btn-sm delete">
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
                                                        @can("delete_box")
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        {{-- <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت </button> --}}
                                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                                        {{-- <br>
                                                        <br>
                                                        @component($prefix_component."state_type",['title'=>' صفحه اصلی','name'=>'state_main'])@endcomponent --}}
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$box->links()}}
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
                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'locker_bank_id','value'=>request()->get('locker_bank_id'),'items'=>$lockerBanks,'title'=>'دسته بندی','key'=>'id','value'=>'full_name','class'=>'w-50'])@endcomponent
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

