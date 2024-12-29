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
                            @if(isset($news[0]))
                                @component($prefix_component."navtab",['number'=>2,'titles'=>['لیست','جستجو']])
                                    @slot("tabContent0")
                                        @component($prefix_component."form",['action'=>route('admin.news.action_all')])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">مدیر</th>
                                                        <th scope="col">دسته بندی</th>
                                                        <th scope="col">ترتیب</th>
                                                        <th scope="col">وضعیت نمایش</th>
                                                        <th scope="col">نمایش در صفحه اصلی</th>
                                                        <th scope="col">تاریخ نمایش</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_news","update_news","read_content"])
                                                        <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($news as $item)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" class="checkbox_item"  name="item[]" value="{{$item['id']}}"></th>
                                                            <td>{{ $loop->iteration + $news->firstItem() - 1 }}
                                                            <td>{{$item["title"]}}</td>
                                                            <td>مدیر اصلی</td>
                                                            <td>{{$item->news_cat->title ?? ""}}</td>
                                                            <td><input type="text" value="{{$item["order"]}}" class="input-order" name="order[{{$item['id']}}]"></td>
                                                            <td>
                                                                @component($prefix_component."state_style",['id'=>$item["id"],"column"=>'state','state'=>$item["state"]])@endcomponent
                                                            </td>
                                                            <td>
                                                                @component($prefix_component."state_style",['id'=>$item["id"],"column"=>'state_main','state'=>$item["state_main"]])@endcomponent
                                                            </td>
                                                            <td>{{$item->date_convert('validity_date')}}</td>
                                                            <td>{{$item->date_convert()}}</td>
                                                            <td>
                                                                @can("update_news")
                                                                    <a href="{{route("admin.news.edit",['news'=>$item['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_news")
                                                                    <a href="javascript:void(0)" data-href="{{route("admin.news.destroy",['news'=>$item['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                                @can("read_content")
                                                                <a href="{{route("admin.content.list",['item_id'=>$item['id'],'module'=>'news'])}}" class="btn btn-primary btn-sm"> محتوا
                                                                    <span class="badge badge-transparent">{{$item->content()->count()}}</span></a>
                                                                </a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_news")
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت </button>
                                                        <button class="btn btn-primary btn-sm" type="submit" name="action_all" value="change_order">تفییر ترتیب </button>
                                                        <br>
                                                        <br>
                                                        @component($prefix_component."state_type",['title'=>' صفحه اصلی','name'=>'state_main'])@endcomponent
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$news->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @endslot
                                    @slot("tabContent1")
                                        @component($prefix_component."form",['method'=>'get'])
                                            @slot("content")
                                                @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
                                                @component($prefix_component."select_recursive",['name'=>'catid','value'=>request()->get('catid'),'options'=>$news_cats_search,'label'=>'دسته بندی','choose'=>true, 'sub_method'=>'sub_cats'])@endcomponent
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

