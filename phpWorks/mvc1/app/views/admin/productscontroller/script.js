$(document).ready(function(){
    $('#form_new_product').submit(function(event){
        event.preventDefault();
        var fdata = new FormData(this);
        
        $.ajax({
            url: window.BASE_DIR + "/products/add/",
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
                }
            }
            
        })
        
        
    });
})

function productDelete(id, name) {
    if (confirm("Вы уверены, что хотите удалить товар \"" + name + "\" с id = " + id + "?")) {
        $.ajax({
            url: window.BASE_DIR + "/products/del/",
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

function productEdit() {
    //let depth_level = $('#form_edit_products select option:selected').data("depth-level") + 1;
    //$('#form_edit_products input[name="depth_level"]').val(depth_level);
    //let data = $('#form_edit_products').serializeArray();
    let data = new FormData(document.forms["form_edit_products"]);
    //console.log(data);
    $.ajax({
        url: window.BASE_DIR + "/products/edit/",
        data: data,
        processData: false,
        contentType: false,
        type: "POST",
        dataType: "json",
        success: function(json){
            if (json.error > 0) {
                $("#form_edit_products .error_danger").show();
            } else {
                location.reload();
            }
        }

    })
}

function getEditFormByID(id) {
    $.ajax({
            url: window.BASE_DIR + `/products/getEditFormByID/${id}/`,
            type: "POST",
            dataType: "html",
            success: function(html){
                $('div.main').append(html);
                $('#edit_products_modal').on('hidden.bs.modal', function (e) {
                    $(e.target).remove();
                })
                $('#edit_products_modal').modal('show');
            
            }
        })
        
}

function showImgFromInput(event) {
    let id_name = "out_".concat(event.target.name); 
    var image = document.getElementById(id_name);
    image.src = URL.createObjectURL(event.target.files[0]);
};
