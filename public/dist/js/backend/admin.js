$(document).ready(function () {
    // check all button
    $('#checkAll').on('ifClicked', function () {
        $(".check").iCheck('check');
    }).on('ifUnchecked', function () {
        $(".check").iCheck('uncheck');
    });

    // change position
    $( "#sortable" ).sortable({
        axis : "y",
        handle  : ".dragGroup",
        deactivate: function( event, ui ) {
            var items = {};
            ui.item.parent().find('tr').each(function(index) {
                var position = index + 1;
                var id = $(this).find('input[name*=id]').val();
                $(this).find('input[name*=position]').val(position);
                $(this).removeAttr('id').attr('id', 'module_' + id + '_' + position);
                items[id] = position;
            });

            $.post(
                url + 'position',
                {
                    items : items
                }
            )
            .done(function () {
                location.reload();
            })
            .fail(function (error) {
                console.log(error);
            });
        }
    }).disableSelection();

    // form validation
    $('#addForm').submit(function () {
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
    });

    // html editor initialise
    $('#editor').length && CKEDITOR.replace( 'editor' );


    $('input').not('.not_icheck').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });

    $(".name_link_rewrite").on("keyup", function () {
        $(this).friendurl({id : 'link_rewrite', divider: '-', transliterate: true});
    });

    $(document).on('change', 'input[type=file]', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(':file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
});

/**
 * Modul deactive
 * @param int id
 * @param int val
 * @param bool all
 */
function deactivate(id, val, all, url) {
    var ansver;

//Stop form from submitting normally
    if(typeof all === 'undefined')
        all = false;

    if(!all)
        ansver = confirm('Вы хотите изменить статус?');
    else
        ansver = true;
    if (ansver) {
        $.post(url+val, {id: id})
            .done(function () {
                location.reload();
            })
            .fail(function (error) {
                console.log(error);
            });
    }

    return false;
}
/**
 * Modul deactive all
 * @param int val
 */
function deactivateAll(val, url) {
    var vals = $(".check:checked").map(function(){
        return $(this).val();
    }).toArray();
    deactivate(vals, val, true, url);

    return false;
}

function clearStatistic(id) {
    $.post( "clear", {id : id}, function( data ) {
        var modalWindow = $('#myModal'),
            jsonData = JSON.parse(data),
            html = jsonData.errors || jsonData.success;

        modalWindow.find('.modal-body').html(html);
        modalWindow.modal();
    });
}
/**
 * Modul delete
 * @param int id
 * @param bool all
 */
function deleteById(id, all, url) {
    if(typeof all === 'undefined')
        all = false;

    if(!all)
        ansver = confirm('Подтвердите удаление.');
    else
        ansver = true;

    if (ansver) {
        $.post(url, {id: id})
            .done(function () {
                location.reload();
            })
            .fail(function (error) {
                console.log(error);
            });
    }

    return false;
}
/**
 * Modul delete all
 */
function deleteAll(url) {
    var vals = $(".check:checked").map(function(){
        return $(this).val();
    }).toArray();
    deleteById(vals, true, url);

    return false;
}


function sort(that) {
    var id = that.val();
    if(id) {
        that.closest('form').submit();
    }

}