$(document).ready(function(){
    $('#form_new_news').submit(function(event){
        event.preventDefault();
        var fdata = new FormData(this);
        
        $.ajax({
            url: window.BASE_DIR + "/news/add/",
            data: fdata,
            processData: false,
            contentType: false,
            dataType: "json",
            type: "POST",
            success: function(json){
                if (json.error > 0) {
                    $(".error_danger").show();
                } else {
                    location.reload();
                    tinymce.remove('#news_text');
                }
            }
            
        })
        
        
    });
})

function newsDelete(id, name) {
    if (confirm("Вы уверены, что хотите удалить новость \"" + name + "\" с id = " + id + "?")) {
        $.ajax({
            url: window.BASE_DIR + "/news/del/",
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

function newsEdit() {
    //let depth_level = $('#form_edit_products select option:selected').data("depth-level") + 1;
    //$('#form_edit_products input[name="depth_level"]').val(depth_level);
    //let data = $('#form_edit_products').serializeArray();
    let data = new FormData(document.forms["form_edit_news"]);
    data.set("news_text_2", tinymce.get("news_text_2").getContent());
    //console.log(data);
    $.ajax({
        url: window.BASE_DIR + "/news/edit/",
        data: data,
        processData: false,
        contentType: false,
        type: "POST",
        dataType: "json",
        success: function(json){
            if (json.error > 0) {
                $("#form_edit_news .error_danger").show();
            } else {
                location.reload();
                tinymce.remove('#news_text_2');
            }
        }

    })
}

function getEditFormByID(id) {
    $.ajax({
        url: window.BASE_DIR + `/news/getEditFormByID/${id}/`,
        type: "POST",
        dataType: "html",
        success: function(html){
            $('div.main').append(html);
            $('#edit_news_modal').on('hidden.bs.modal', function (e) {
                $(e.target).remove();
            })
            $('#edit_news_modal').modal('show');
        }
    })
        
}

function showImgFromInput(event) {
    let id_name = "out_".concat(event.target.name); 
    var image = document.getElementById(id_name);
    image.src = URL.createObjectURL(event.target.files[0]);
};
