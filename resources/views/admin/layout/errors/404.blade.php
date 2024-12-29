@extends("admin.layout.base")
@php $module_name=404 @endphp
@section("title")
    {{$module_name}}
@endsection
@section("content")
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        صفحه مورد نظر شما یافت نشد.
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
