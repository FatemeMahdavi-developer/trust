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
                                    @if(isset($order[0]))
                                        @component($prefix_component."form",['action'=>route('admin.order.action_all')])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">سایز</th>
                                                        <th scope="col">کاربر</th>
                                                        {{-- <th scope="col">وضعیت نمایش</th> --}}
                                                        <th scope="col">کد پیگیری</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_order","update_order"])
                                                            <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order as $item)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" class="checkbox_item"  name="item[]" value="{{$item['id']}}"></th>
                                                            <td>{{ $loop->iteration + $order->firstItem() - 1 }}
                                                            <td>{{$item->basket->box->title}}</td>
                                                            <td>{{$item->size->title}}</td>
                                                            <td>{{$item->user->fullname}}</td>
                                                            {{-- <td>
                                                                {{$status[$item->state->value]}}
                                                            </td> --}}
                                                            <td>{{$item->ref_number}}</td>
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_order")
                                                                <a href="{{route("admin.order.edit",['order'=>$item['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_order")
                                                                <a href="javascript:void(0)" data-href="{{route("admin.order.destroy",['order'=>$item['id']])}}" class="btn btn-danger btn-sm delete">
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
                                                        @can("delete_order")
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$order->links()}}
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

