/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
"use strict";
$("#check_all").click(function () {
    $("table tbody .checkbox_item").prop('checked', $(this).prop('checked'));
});




function toaste(type_icon,msg,timer=1000){
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: type_icon,
        title: msg
    });
}
$(".input-order").keydown(function (event) {
    // 13 is the keycode for Enter key
    if (event.which === 13) {
        event.preventDefault(); // Prevent default action of Enter key
        return false; // Prevent further propagation
    }
});



$(".delete").click(function () {
    var href = $(this).data("href")
    Swal.fire({
        title: messages['is_delete'],
        icon: "",
        iconHtml: '',
        confirmButtonText: messages["yes"],
        cancelButtonText: messages["no"],
        showCancelButton: true,
        showCloseButton: true,

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: href,
                type: 'DELETE',
                data: {
                    '_token': $("input[name='_token']").val(),
                },
                success: function (response) {
                    toaste("success",messages['success_delete'])
                    setTimeout(function () {
                        location.reload();
                    }, 1000)
                },
                error: function () {
                    toaste("error",messages['error_to_connecting'])
                }
            });
        }
    });
})


$("button[name='action_all']").click(function (e) {
    e.preventDefault();
    var url = $("form#action_all").attr("action")
    var data = $("#action_all").serialize() + "&" + "action_type=" + $(this).val()
    if ($(this).val() == "delete_all") {
        var href = $(this).data("href")
        Swal.fire({
            title: messages['is_delete'],
            icon: "",
            iconHtml: '',
            confirmButtonText: messages["yes"],
            cancelButtonText: messages["no"],
            showCancelButton: true,
            showCloseButton: true,

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (res) {
                        if ($(res['errors']).length) {
                            toaste("error",messages['choose'],2000)
                        } else {
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        }
                    },
                    error: function () {
                        toaste("error",messages['error_to_connecting'],2000)
                    }
                })
            }
        });
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (res) {
                if ($(res['errors']).length) {
                    toaste("error",messages['choose'],2000)
                } else {
                    setTimeout(function () {

                        location.reload();
                    }, 1000)
                }
            },
            error: function () {
                toaste("error",messages['error_to_connecting'],2000)
            }
        })
    }

})


$(".state_action").on('change', function () {
    $("[value='change_state_main']").trigger("click")
})

$(".state_menu_action").on('change', function () {
    $("[value='change_state_menu']").trigger("click")
})


$(".state_checkbox").on('change',function () {
    var url = $("form#action_all").attr("action")
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data:{'item':$(this).attr("data-item"),'_token':$("[name='_token']").val(),'column_name':$(this).attr("data-column"),'action_type':'change_state_item'},
        error:function () {
            toaste("error",messages['error_to_connecting'],2000)
        }
    })
})






function change_province(url,val_province){
    $.ajax({
        url: url,
        method: "post",
        dataType: "json",
        data: {
            '_token': $("input[name='_token']").val(),
            'province_id': val_province
        },
        success: function (result) {
            $("[name='city'] option").remove()
            if (result.length > 0) {
                $(result).each(function (index, element) {
                    $("[name='city']").append("<option value=" + element['id'] + ">" + element['name'] + "</option>")
                })
                $("[name='city']").prepend("<option selected value=''>انتخاب کنید</option>")
            } else {
                $("[name='city']").append("<option value=''>نتیجه ای یافت نشد</option>")
            }
        },
        error: function () {
            toaste("error", "خطا در برقراری ارتباط")
        }
    })
}

$(document).ready(function (){
    $(".variables a").click(function (){
        var textarea=$(this).parent().parent().find("textarea");
        textarea.val(textarea.val()+$(this).text())
    })
})
