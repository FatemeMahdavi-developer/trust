@extends("admin.layout.base")
@php $module_name= $module_title . " جدید "@endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between  ">
                            <h4>{{$module_name}}</h4>
                        </div>
                        <div class="card-body">
                            @component($prefix_component."form",['action'=>route('admin.role.update',["role"=>$role["id"]])])
                            @component($prefix_component."input_hidden",['value'=>$role['id']])@endcomponent
                                @slot("content")
                                @method("put")
                                @component($prefix_component."input",['name'=>'title','title'=>'عنوان','value'=>$role["title"],'class'=>'w-50'])@endcomponent
                                    @error("permissions")
                                    <div class="text text-danger">{{$errors->first('permissions')}}</div>
                                    @enderror
                                    <div class="col-12 d-flex flex-wrap">
                                        @foreach($modules_permission as $key => $permissions)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="card">
                                                <div class="card-header" style="background:#f5f5f5;">
                                                    <h4>{{$key}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group mb-0">
                                                            @foreach($permissions as $key => $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="{{$value}}" type="checkbox"
                                                                       id="gridCheck{{$value}}" @if(in_array($value,$role->permission->pluck("id")->toArray())) checked @endif  name="permissions[]">
                                                                <label class="form-check-label" for="gridCheck{{$value}}">
                                                                    {{$key}}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @component($prefix_component."button",['title'=>'ارسال'])@endcomponent
                                @endslot
                            @endcomponent
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
