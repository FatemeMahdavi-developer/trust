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
                    @if(isset($photo_cats[0]))
                        @component($prefix_component."form",['action'=>route("admin.photo_cat.action_all")])
                            @slot("content")
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                        <th scope="col">ردیف</th>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">تصاویر</th>
                                        <th scope="col">وضعیت نمایش</th>
                                        {{-- <th scope="col">نمایش در صفحه اصلی</th> --}}
                                        <th scope="col">ترتیب</th>
                                        <th scope="col">تاریخ</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($photo_cats as $photo_cat)
                                        <tr>
                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item" value="{{$photo_cat['id']}}"></th>
                                            <td>{{ $loop->iteration + $photo_cats->firstItem() - 1 }}
                                            </td>
                                            <td>{{$photo_cat["title"]}}</td>
                                            <td><a href="{{route("admin.photo.index",['catid'=>$photo_cat['id']])}}">{{$photo_cat->gallery->count('id')}}</a></td>
                                            <td> @component($prefix_component."state_style",['id'=>$photo_cat["id"],"column"=>'state','state'=>$photo_cat["state"]])@endcomponent</td>
                                            {{-- <td>@component($prefix_component."state_style",['id'=>$photo_cat["id"],"column"=>'state_main','state'=>$photo_cat["state_main"]])@endcomponent</td> --}}
                                            <td><input type="text" value="{{$photo_cat["order"]}}" class="input-order" name="order[{{$photo_cat['id']}}]"></td>
                                            <td>{{$photo_cat->date_convert()}}</td>
                                            <td>
                                                @can("update_photo_cat")
                                                <a href="{{route("admin.photo_cat.edit",['photo_cat'=>$photo_cat['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can("delete_photo_cat")
                                                <a href="javascript:void(0)" data-href="{{route("admin.photo_cat.destroy",['photo_cat'=>$photo_cat['id']])}}" class="btn btn-danger btn-sm delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan
                                                <a href="?catid={{$photo_cat['id']}}" class="btn btn-primary btn-sm">زیر بخش :<span class="badge badge-transparent">{{$photo_cat->sub_cats()->count()}}</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-5">
                                        @can("delete_photo_cat")
                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                        @endcan
                                        @can("read_photo_cat")
                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب</button>
                                        {{-- <br>
                                        <br>
                                        @component($prefix_component."state_type",['title'=>'صفحه اصلی','name'=>'state_main'])@endcomponent --}}
                                        @endcan
                                    </div>
                                    <div class="col-7 d-flex justify-content-end">
                                        {{$photo_cats->links()}}
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
                            @component($prefix_component."select_recursive",['name'=>'catid','value'=>request()->get('catid'),'options'=>$photo_cats_search,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats'])@endcomponent
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