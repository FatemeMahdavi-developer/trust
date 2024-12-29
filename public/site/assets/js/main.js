$(document).ready
(
    function () {
        // menu
        $(".menu .col-level-2 a").mouseenter
        (
            function () {
                let catId = $(this).attr("data-cat-id");

                $(".menu .col-level-2 a, .menu .col-level-3").removeClass("active");
                $(".menu .col-level-2 a[data-cat-id=" + catId + "]").addClass("active");
                $(".menu .col-level-3[data-cat-id=" + catId + "]").addClass("active");
            }
        );

        $('.menu .level-1').mouseenter
        (
            function () {
                $(this).doTimeout
                (
                    'hover',
                    300,
                    function (elem) {
                        $(this).addClass("active");
                        $(this).find(".level-2").slideDown();
                    }
                );
            }
        ).mouseleave
        (
            function () {
                $(this).doTimeout
                (
                    'hover',
                    300,
                    function (elem) {
                        $(this).removeClass("active");
                        $(this).find(".level-2").slideUp();
                    }
                );
            }
        );

        // sign in
        $('.btn-form-sign-in-password').click
        (
            function () {
                if ($('.form-sign-in-password').attr('type') === 'text') {
                    $('.form-sign-in-password').attr('type', 'password');
                    $('.btn-form-sign-in-password').removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    $('.form-sign-in-password').attr('type', 'text');
                    $('.btn-form-sign-in-password').removeClass('bi-eye').addClass('bi-eye-slash');
                }
            }
        );

        // mobile side menu
        $('.mobile-side-menu .nav-dropdown-toggle').click
        (
            function () {
                $(this).toggleClass('open');
                $(this.nextElementSibling).slideToggle();

                return false;
            }
        );

        // select2
        $('.select-box-select2').select2
        ({
            language: "fa",
            dir: "rtl"
        });

        // checkbox new style
        $('.label-input-checkbox-by-style input').change
        (
            function () {
                $(this).parents('label').toggleClass('active-checked');
            }
        );

        // show password
        $('.btn-show-password').click
        (
            function () {
                var obj = $(this).parent().find("input");

                if (obj.attr('type') === 'text') {
                    obj.attr('type', 'password');
                    $(this).removeClass('fi-rr-eye-crossed').addClass('fi-rr-eye');
                } else {
                    obj.attr('type', 'text');
                    $(this).removeClass('fi-rr-eye').addClass('fi-rr-eye-crossed');
                }
            }
        );
        $("#send_mail_share").on('submit', function (e) {
            e.preventDefault()
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $("#send_mail_share").serialize(),
                dataType: "JSON",
                success: function (res) {
                    $(".modal-body .alert").remove()
                    if (typeof (res.email) != "undefined") {
                        $(".social-share").after("<div class=\"alert alert-danger my-3 p-2\">" + res.email[0] + "</div>")
                    } else {
                        if (typeof (res.success) != "undefined") {
                            $(".social-share").after("<div class=\"alert alert-success my-3 p-2\">" + res.success + "</div>")
                            $("#send_mail_share").slideUp()
                        }
                    }
                    // if (typeof(res.error) != "undefined") {
                    //
                    //     $(".social-share").after("<div class=\"alert alert-danger my-3 p-2\">داداش این تست ها</div>")
                    // }
                },
                error: function () {
                    alert("error to sending ajax data")
                }
            })
        });


        $(".form_comment").submit(function (e) {
            e.preventDefault()
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function (res) {
                    $(".form_comment").parent().find(".text.text-danger").remove()
                    if (typeof res.success !== 'undefined') {
                        $(".form_comment").slideUp()
                        $(".form_comment").before("<div class='alert alert-success'>نظر شما ثبت شد</div>")
                        // your code here
                    } else {
                        $(res).each(function (index, element) {
                            $.each(element, function (index2, element2) {
                                $(".form_comment [name="+index2+"]").after("<span class='text text-danger'>" + element2 + "</span>")
                            })
                        })
                    }
                },
                error: function (res) {
                    alert(("error to sending ajax data"))
                }
            })
        })
    }
);
