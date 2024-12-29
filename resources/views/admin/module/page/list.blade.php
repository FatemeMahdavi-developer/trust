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
                                    @if(isset($pages[0]))
                                        @component($prefix_component."form",['action'=>route("admin.page.action_all")])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">نمایش صفحه</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_page","update_page","read_content"])
                                                        <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($pages as $page)
                                                        <tr>
                                                            <th scope="row"><input type="checkbox" name="item[]" class="checkbox_item" value="{{$page['id']}}"></th>
                                                            <td>{{ $loop->iteration + $pages->firstItem() - 1 }}</td>
                                                            <td>{{$page["title"]}}</td>
                                                            <td>@component($prefix_component."state_style",['id'=>$page["id"],"column"=>'state','state'=>$page["state"]])@endcomponent</td>
                                                            <td>
                                                                <a href="{{route("page",["pages"=>$page["seo_url"]])}}" class="btn btn-primary btn-sm">مشاهده صفحه</a>
                                                            </td>
                                                            <td>{{$page->date_convert()}}</td>
                                                            <td>
                                                                @can("update_page")
                                                                <a href="{{route("admin.page.edit",['page'=>$page['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_page")
                                                                <a href="javascript:void(0)" data-href="{{route("admin.page.destroy",['page'=>$page['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                                @can("read_content")
                                                                <a href="{{route("admin.content.list",['item_id'=>$page['id'],'module'=>'page'])}}" class="btn btn-primary btn-sm">محتوا<span class="badge badge-transparent">{{$page->content()->count()}}</span></a></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_page")
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$pages->links()}}
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    @else
                                        <div
                                            class="alert alert-danger">{{__('common.messages.result_not_found')}}</div>
                                    @endif
                                @endslot

                                @slot("tabContent1")
                                    @component($prefix_component."form",['method'=>'get'])
                                        @slot("content")

                                            @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>request()->get("title"),'class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'kind','title'=>'نوع','class'=>'w-50','items'=>trans("common.kind"),'value_old'=>request()->get('kind')])@endcomponent

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
@section("footer")

@endsection
