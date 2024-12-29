<!doctype html>
<html lang="fa">
<head>
    @yield('seo')
    @include("site.layout.partials.head")
    @yield('head')

</head>
<body>
@if(!str_contains(request()->route()->getName(),'auth'))
    @include("site.layout.partials.header")
@endif
@yield('content')
@if(!str_contains(request()->route()->getName(),'auth'))
    @include("site.layout.partials.footer")
@endif
@include("site.layout.partials.modal")
@include('site.layout.partials.footer_js')
@yield('footer')
<script>
    $(document).ready(function () {
        $('body').persiaNumber();

        $(".select2").select2({
            placeholder: "انتخاب کنید",
            theme: "default",
            dir: "rtl",
            language: "fa"
        })
    });
</script>
@auth
    <script>
        $(".form_change_pass").submit(function (e) {
            e.preventDefault()
            $.ajax({
                url: "{{route("user.change_pass")}}",
                data: $(".form_change_pass").serialize(),
                dataType: "json",
                method: $(".form_change_pass").attr("method"),
                success: function (res) {
                    $(".form_change_pass .text-danger").remove()
                    if ($(res['errors']).length) {
                        $(res['errors']).each(function (index, element) {
                            $(".form_change_pass input").each(function (inputIndex, inputElement) {
                                var name = $(inputElement).attr("name")
                                if ($(element[name]).length) {
                                    $("[name='" + name + "']").after("<span class='text text-danger'>" + element[name] + "</span>")
                                }
                            })
                        })
                    }
                    if (res == "ok") {
                        $(".form_change_pass").prepend("<div class='alert alert-success'>تغییر رمز عبور انجام شد</div>")
                        setTimeout(function () {
                            window.location.reload()
                        }, 4000)
                    }
                },
                error: function () {
                    alert("error to sending ajax data")
                }
            })
        })
    </script>
@endauth
</body>
</html>
