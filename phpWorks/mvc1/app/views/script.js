$(document).ready(function() {
    
})

function openDialogLogin(){

    
    // $. или jQuery. - это тоже самое
    jQuery.ajax({
        url: window.BASE_DIR_AJAX+"/loginForm.php", // window - глобальный объект окна
        dataType: "html",
        success: function(html){
            $('body').append(html);
            
            let modalObj = new bootstrap.Modal(document.getElementById('login_form'));

            $('#login_form').on('hide.bs.modal', function (event) {
                $(this).remove();
            })
            $('#login_form').submit(function(event){
                globalLogin(event);
            })
            modalObj.show();
        }
        
    })

}

function globalLogin(event){
    event.preventDefault();
    
    let form = $(event.target);
    
    let form_data = form.serializeArray();
    
    $.ajax({
        url:"/phpWorks/mvc1/reg/login/",
        type:"POST",
        data: form_data,
        dataType: "json",
        beforeSend: function(){
            form.find('input').each(function (i, e){
                $(e).attr('disabled', 'disabled');
            });
            
            form.find('.alert-danger').addClass('d-none');
            form.find('button[type="submit"]').hide();
            form.find('.loader08').removeClass("d-none");
        },
        success: function(json) {
            if (json.error != '') {
                form.find('.alert-danger').removeClass('d-none').html(json.error);
                form.find('input').each(function (i, e){
                    $(e).removeAttr('disabled');
                });
                
                form.find('button[type="submit"]').show();
                form.find('.loader08').addClass("d-none");
            } else {
                location.reload();
            }
        }
    })
}