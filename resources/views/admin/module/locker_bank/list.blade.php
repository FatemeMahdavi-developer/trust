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

                            @if(isset($lockerBank[0]))
                                @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                    @slot("tabContent0")
                                        @component($prefix_component."form",['action'=>route("admin.locker-bank.action_all")])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">کد</th>
                                                        <th scope="col">شعبه</th>
                                                        <th scope="col">سایز</th>
                                                        <th scope="col">نمایش بارکد</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(['update_locker_bank','delete_locker_bank'])
                                                            <th scope="col">عملیات</th>
                                                        @endcanany
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lockerBank as $item)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" name="item[]"
                                                                                   class="checkbox_item"
                                                                                   value="{{$item['id']}}"></th>
                                                            <td>{{ $loop->iteration + $lockerBank->firstItem() - 1 }}</td>
                                                            <td>{{$item["code"]}}</td>
                                                            <td>{{$item->branch->name ?? ""}}</td>
                                                            <td>{{$item["size"]}}</td>
                                                            <td><a href="/{{$item['qrcode']}}" target="_blank">نمایش
                                                                    بارکد</a></td>
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_locker_bank")
                                                                    <a href="{{route("admin.locker-bank.edit",['locker_bank'=>$item['id']])}}"
                                                                       class="btn btn-success btn-sm"><i
                                                                            class="fas fa-edit"></i></a>
                                                                @endcanany
                                                                @can("delete_locker_bank")
                                                                    <a href="javascript:void(0)"
                                                                       data-href="{{route("admin.locker-bank.destroy",['locker_bank'=>$item['id']])}}"
                                                                       class="btn btn-danger btn-sm delete"><i
                                                                            class="fas fa-trash"></i></a>
                                                            @endcan
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_locker_bank")
                                                            <button class="btn btn-danger btn-sm" type="submit"
                                                                    name="action_all" value="delete_all">حذف کلی
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot

                                    @slot("tabContent1")
                                        @component($prefix_component."form",['method'=>'get'])
                                            @slot("content")

                                                @component($prefix_component."input",['name'=>'code','title'=>' کد','value'=>request()->get("code"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."select",['name'=>'branch_id','title'=>'شعبه','key'=>'id','value'=>'name','class'=>'w-50','items'=>$branches,'value_old'=>request()->get("branch_id")])@endcomponent
                                                @component($prefix_component."select",['name'=>'size','title'=>'سایز','class'=>'w-50','items'=>$size,'value_old'=>request()->get("size")])@endcomponent
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
@section("footer")

@endsection
