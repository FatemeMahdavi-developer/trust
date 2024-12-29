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
                                    @if(isset($comment[0]))
                                        @component($prefix_component."form",['action'=>route("admin.comment.action_all")])
                                            @slot("content")
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="check_all"></th>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">بخش</th>
                                                        <th scope="col">عنوان</th>
                                                        <th scope="col">آدرس</th>
                                                        <th scope="col">وضعیت نمایش</th>
                                                        <th scope="col">وضعیت پاسخ</th>
                                                        <th scope="col">تاریخ</th>
                                                        @canany(["delete_comment","update_comment"])
                                                        <th scope="col">عملیات</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($comment as $item)
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" name="item[]" class="checkbox_item" value="{{$item['id']}}"></th>
                                                            <td>
                                                                {{ $loop->iteration + $comment->firstItem() - 1 }}
                                                            </td>
                                                            <td>{{$item->nameModule}}</td>
                                                            <td>{{$item->commentable->title ?? ''}}</td>
                                                            <td><a href="{{$item->commentable->url}}" target="_blank" class="btn btn-primary btn-sm">مشاهده نظر</a></td>
                                                            <td>
                                                                @component($prefix_component."state_style",['id'=>$item["id"],"column"=>'state','state'=>$item["state"]])@endcomponent
                                                            </td>
                                                            <td>
                                                                {{is_null($item->response_note) ? "ندارد" : "دارد"}}
                                                            </td>
                                                            <td>{{$item->date_convert('created_at')}}</td>
                                                            <td>
                                                                @can("update_comment")
                                                                    <a href="{{route("admin.comment.edit",['comment'=>$item['id']])}}"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                @endcan
                                                                @can("delete_comment")
                                                                    <a href="javascript:void(0)" data-href="{{route("admin.comment.destroy",['comment'=>$item['id']])}}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col-5">
                                                        @can("delete_comment")
                                                            <button class="btn btn-danger btn-sm" type="submit" name="action_all" value="delete_all">حذف کلی</button>
                                                        @endcan
                                                        <button class="btn btn-success btn-sm" type="submit" name="action_all" value="change_state">تفییر وضعیت</button>
                                                    </div>
                                                    <div class="col-7 d-flex justify-content-end">
                                                        {{$comment->links()}}
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
                                            @component($prefix_component."datepicker",['name'=>'start_time_at','title'=>'از تاریخ','value'=>request()->get('start_time_at') ?? '','class'=>'w-50'])@endcomponent
                                            @component($prefix_component."datepicker",['name'=>'end_time_at','title'=>'تا تاریخ','value'=>request()->get('end_time_at') ?? '','class'=>'w-50'])@endcomponent
                                            @component($prefix_component."select",['name'=>'section','title'=>'بخش','class'=>'w-50','items'=>$modules,'value_old'=>request()->get('section')])@endcomponent
                                            @component($prefix_component."select",['name'=>'state','title'=>'وضعیت','class'=>'w-50','items'=>trans('common.state'),'value_old'=>request()->get('state')])@endcomponent
                                            @component($prefix_component."select",['name'=>'have_response','title'=>'پاسخ','class'=>'w-50','items'=>trans('common.have'),'value_old'=>request()->get('have_response')])@endcomponent
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
