$(document).ready(function(){
    
    $('#reg_form').submit(function( event ){
        event.preventDefault(); // прекрати выполнение собьытий, но делай далее определенный код
        let form = $(event.target);
        
        let form_data = form.serializeArray();
        
        let data = [];
        
        for ( let item in form_data) {
            // поскольу item в данном случае будет индексом некоторого массива, то через него можно обращаться к его элементам
            data[form_data[item]['name']] = form_data[item]['value'];
        }
        console.log(data);
        
        // Проверяем, что пароли совпадают при регистрации
        if (data['password'] != data['password_confirm']){
            $(".pass_error").removeClass("d-none");
            setTimeout(function(){$(".pass_error").addClass("d-none");}, 5000);
            return false;
        }
        
        let obj = {};
        Object.assign(obj, data); // перевели массив в объект
        console.log(obj);
        
        // .ajax - функция jquery --- https://page2page.lohmach.info/index.php5/Ajax-%d0%b7%d0%b0%d0%bf%d1%80%d0%be%d1%81.html
        $.ajax({
            url:"/phpWorks/mvc1/reg/registration/",
            type:"POST",
            data: obj,
            dataType: "json",
            success: function( json ){
                console.log(json);
                if (json.error.length > 0) {
                    $(".server_error").text(json.error).removeClass("d-none");
                } else {
                    let modal = `
                    <div class="modal" id="success_reg" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Добро пожаловать, ${obj.user}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Регистрация прошла успешно</p>
                              <p>Ваши данные будут переданы третьим лицам в ближайщее время!</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ок</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    `;
                    $('body').append(modal);
                    let modalObj = new bootstrap.Modal(document.getElementById('success_reg'));
                    
                    $('#success_reg').on('hide.bs.modal', function (event) {
                        location.href = '/phpWorks/mvc1/';
                    })
                    
                    modalObj.show();
                }
            }
        })
    })
})


