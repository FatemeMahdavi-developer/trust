@extends("admin.layout.base_auth")
@section("title")
    {{$module_title}}
@endsection
@section("content")
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{$module_title}}</h4>
                        </div>
                        @if($errors->has("login_failed"))
                            <div class="alert alert-danger">{{$errors->first('login_failed')}}</div>
                        @endif
                      <div class="card-body">
                            @component("components.admin.form",['action'=>route('admin.auth.store')])
                                @slot("content")
                                    @component($prefix_component."input",['name'=>'username','title'=>'نام کاربری','class'=>'w-100','value'=>old("username")])@endcomponent
                                    @component($prefix_component."input",['name'=>'password','title'=>'رمزعبور','type'=>'password','class'=>'w-100'])@endcomponent
                                    @component($prefix_component."button",['title'=>'ورود','class'=>'w-100 btn-primary'])@endcomponent
                                @endslot
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
