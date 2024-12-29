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
                    @if(isset($message_cats[0]))
                        @component($prefix_component."form",['action'=>route("admin.message_cat.action_all")])
                            @slot("content")
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                        <th scope="col">ردیف</th>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">پیام ها</th>
                                        <th scope="col">وضعیت نمایش</th>
                                        <th scope="col">ترتیب</th>
                                        <th scope="col">تاریخ</th>
                                        @canany(["delete_message_cat","update_message_cat"])
                                            <th scope="col">عملیات</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($message_cats as $message_cat)
                                        <tr>
                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item" value="{{$message_cat['id']}}"></th>
                                            <td>{{ $loop->iteration + $message_cats->firstItem() - 1 }}
                                            </td>
                                            <td>{{$message_cat["title"]}}</td>
                                            {{-- <td><a href="{{route("admin.product.index",['catid'=>$message_cat['id']])}}">{{$message_cat->product->count('id')}}</a></td> --}}
                                            <td><a href=""> - </a></td>
                                            <td> @component($prefix_component."state_style",['id'=>$message_cat["id"],"column"=>'state','state'=>$message_cat["state"]])@endcomponent</td>
                                            <td><input type="text" value="{{$message_cat["order"]}}" class="input-order" name="order[{{$message_cat['id']}}]"></td>
                                            <td>{{$message_cat->date_convert()}}</td>
                                            <td>
                                                @can("update_message_cat")
                                                <a href="{{route("admin.message_cat.edit",['message_cat'=>$message_cat['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can("delete_message_cat")
                                                <a href="javascript:void(0)" data-href="{{route("admin.message_cat.destroy",['message_cat'=>$message_cat['id']])}}" class="btn btn-danger btn-sm delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan
                                                <a href="?catid={{$message_cat['id']}}" class="btn btn-primary btn-sm">زیر بخش :<span class="badge badge-transparent">{{$message_cat->sub_cats()->count()}}</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-5">
                                        @can("delete_message_cat")
                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                        @endcan
                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        {{$message_cats->links()}}
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
                            @component($prefix_component."select_recursive",['name'=>'catid','value'=>request()->get('catid'),'options'=>$message_cats_search,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats'])@endcomponent
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