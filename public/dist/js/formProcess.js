/**
 * Created by devrim on 2/11/2015.
 */

$(document).ready(function () {

    ////Find the box parent
    var box = $("#collapse_load").first();

    //Find the body and the footer
    var bf = box.find(".box-body, .box-footer");

    if (box.hasClass("collapsed-box")) {
        //box.addClass("collapsed-box");
        //Convert minus into plus
        $(this).children(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
        bf.slideUp();
    } else {
        box.removeClass("collapsed-box");
        //Convert plus into minus
        $(this).children(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
        bf.slideDown();
    }
});

/**
 * Kayıt Durumu Değişikliği
 * @param int id
 * @param string val
 */
function recordAction(id, status, val) {

//Stop form from submitting normally
    event.preventDefault();

    if (confirm('Bu kaydın durumunu değiştirmek istiyor musunuz?')) {

        if (status != 1) {
            $.post("/admin/" + val, {id: id})
                .done(function () {
                    //console.log(data);
                    location.reload();
                })
                .fail(function (error) {
                    console.log(error);
                })
        } else {
            $.post("/admin/" + val, {id: id})
                .done(function () {
                    location.reload();
                })
                .fail(function (error) {
                    console.log(error);
                })
        }
    } else {
        // Do nothing!
    }
}

/* Add Function */
$(function () {
    $('#addForm').submit(function (e) {
        e.preventDefault();

        $(".message").hide();

        jQuery('input').attr('data-prompt-position', 'bottomLeft');
        jQuery('input').data('promptPosition', 'bottomLeft');
        jQuery('textarea').attr('data-prompt-position', 'bottomLeft');
        jQuery('textarea').data('promptPosition', 'bottomLeft');
        jQuery('select').attr('data-prompt-position', 'bottomLeft');
        jQuery('select').data('promptPosition', 'bottomLeft');

        //if invalid do nothing
        if (!$('#addForm').validationEngine('validate')) {
            return false;
        }

        var form = document.getElementById('addForm');
        var formData = new FormData(form);
        var formUrl = $("#addForm").attr('action');

        $.ajax({
            type: "POST",
            url: formUrl,
            data: formData,
            async: false,
            success: function (data) {
                $(".message").html(data);
                $(".message").fadeIn("slow");
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
});

/* Delete Function */
$('#delete').click(function () {

    event.preventDefault();

    var DeleteUrl = $("input[name=DeleteURL]").val();
    var count_checked = $("[name='fieldID[]']:checked").length; // count the checked

    if (count_checked == 0) {
        alert("Lütfen bir kayıt seçiniz");
        return false;
    }

    if (count_checked > 0) {
        if (confirm("Kayıtları silmek istiyor musunuz?")) {
            $.post(DeleteUrl, $("[name='fieldID[]']:checked").serialize(), function () {
                location.reload();
            });
        }
    }
});

/* Order Function */
$('#order').click(function () {

    event.preventDefault();

    var OrderUrl = $("input[name=SeqURL]").val();
    var OrderFields = $("input[name='seq[]'], [name='seqID[]']").serialize();

    if (OrderFields != '') {
        if (confirm("Kayıtları sıralamak istiyor musunuz?")) {
            $.post(OrderUrl, OrderFields, function (data) {
                location.reload();
                //console.log(data);
            });
        }
    }
});

/* Delete News Photo Function */
$('.delete').click(function (e) {
    e.preventDefault();

    var id = $(this).attr("id");
    var parent = $(this).parent();

    $.ajax({
        type: 'POST',
        url: "/admin/news/delete/photo",
        data: {'id': id},
        beforeSend: function () {
            parent.animate({'backgroundColor': '#fb6c6c'}, 300);
        },
        success: function () {
            $(".record").slideUp(300, function () {
                $(".record").remove();
            });
        }
    });
});

/* Create Seo URL */
$("#title").on("input", function () {

    var baslik = $(this).val();

    //Show seo URL Info
    if ((baslik).length > 1) {
        $(".seo_url").fadeIn("slow");
    } else {
        $(".seo_url").fadeOut("slow");
    }

    $("#seo_hidden").val($("#seo_url").html());

        $('#title').friendurl({id : 'seo_url', divider: '-', transliterate: true});

});

/* Sub Menu */
$("#SubMenu li a").click(function (e) {

    e.preventDefault;

    var menuID = $(this).attr("id");
    $('.menuSelect').removeClass('menuSelect');
    $(this).addClass('menuSelect');

    $("#changePageID").val(menuID);
});

$("#cleanMenu").click(function () {
    $('#SubMenu li a').removeClass('menuSelect');
    $("#changePageID").val("");
});