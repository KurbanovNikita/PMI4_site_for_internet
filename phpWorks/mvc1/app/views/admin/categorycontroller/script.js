$(document).ready(function(){
    $('#form_new_category').submit(function(event){
        event.preventDefault();
        let depth_level = $('#form_new_category select option:selected').data("depth-level") + 1;
        $('#form_new_category input[name="depth_level"]').val(depth_level);
        let data = $('#form_new_category').serializeArray();
        
        $.ajax({
            url: window.BASE_DIR + "/category/add/",
            data: data,
            type: "POST",
            dataType: "json",
            success: function(json){
                if (json.error > 0) {
                    $("#new_category_modal .error_danger").show();
                } else {
                    location.reload();
                }
            }
            
        })
    });

    
})

function categoryDelete(id, name) {
    if (confirm("Вы уверены, что хотите удалить категорию \"" + name + "\" с id = " + id)) {
        $.ajax({
            url: window.BASE_DIR + "/category/del/",
            data: {id:id},
            type: "POST",
            dataType: "json",
            success: function(json){
                if (json.error > 0) {
                    alert('Ошибка удаления');
                } else {
                    location.reload();
                }
            }
        })
    }
}

function categoryEdit() {
    let depth_level = $('#form_edit_category select option:selected').data("depth-level") + 1;
    $('#form_edit_category input[name="depth_level"]').val(depth_level);
    let data = $('#form_edit_category').serializeArray();

    $.ajax({
        url: window.BASE_DIR + "/category/edit/",
        data: data,
        type: "POST",
        dataType: "json",
        success: function(json){
            if (json.error > 0) {
                $("#form_edit_category .error_danger").show();
            } else {
                location.reload();
            }
        }

    })
}

function getEditFormByID(id) {
    $.ajax({
            url: window.BASE_DIR + `/category/getEditFormByID/${id}/`,
            type: "POST",
            dataType: "html",
            success: function(html){
                $('div.main').append(html);
                $('#edit_category_modal').on('hidden.bs.modal', function (e) {
                    $(e.target).remove();
                })
                $('#edit_category_modal').modal('show');
            
            }
        })
}