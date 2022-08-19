$(document).ready(function(){ // все события мы вешаем, когда документ готов
    $('#form_new_section').submit(function(event){
        event.preventDefault();
        let depth_level = $('#form_new_section select option:selected').data("depth-level") + 1;
        $('#form_new_section input[name="depth_level"]').val(depth_level);
        let data = $('#form_new_section').serializeArray();
        
        $.ajax({
            url: window.BASE_DIR + "/sections/add/",
            data: data,
            type: "POST",
            dataType: "json",
            success: function(json){
                if (json.error > 0) {
                    $("#new_section_modal .error_danger").show();
                } else {
                    location.reload();
                }
            }
            
        })
    });
})

function sectionDelete(id, name) {
    if (confirm("Вы уверены, что хотите удалить категорию \"" + name + "\" с id = " + id)) {
        $.ajax({
            url: window.BASE_DIR + "/sections/del/",
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

function sectionEdit() {
    let depth_level = $('#form_edit_section select option:selected').data("depth-level") + 1;
    $('#form_edit_section input[name="depth_level"]').val(depth_level);
    let data = $('#form_edit_section').serializeArray();

    $.ajax({
        url: window.BASE_DIR + "/sections/edit/",
        data: data,
        type: "POST",
        dataType: "json",
        success: function(json){
            if (json.error > 0) {
                $("#form_edit_section .error_danger").show();
            } else {
                location.reload();
            }
        }

    })
}

function getEditFormByID(id) {
    $.ajax({
            url: window.BASE_DIR + `/sections/getEditFormByID/${id}/`,
            type: "POST",
            dataType: "html",
            success: function(html){
                $('div.main').append(html);
                $('#edit_section_modal').on('hidden.bs.modal', function (e) {
                    $(e.target).remove();
                })
                $('#edit_section_modal').modal('show');
            
            }
        })
}