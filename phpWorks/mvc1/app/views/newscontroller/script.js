$(document).ready(function(){
    $('#new_commentaries').submit(function(event){
    });
    
    var id = window.location.search.toString().split("?")[1];
    
    $.ajax({
        url: window.BASE_DIR + `/news/showNewsByID/${id}/`,
        type: "POST",
        dataType: "html",
        success: function(html){
            $('div.main_container').append(html);

        }
        }
    )
    if($('head').append("<link href='/phpWorks/mvc1/app/views/newscontroller/style.css?"+Math.floor(Math.random()*10000000) + 1+"' rel='stylesheet'/>")) {
        console.log("css live");
    }
    
})

function commentDelete(id) {
    if (confirm("Вы уверены, что хотите удалить свой комментарий?")) {
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

function add_new_comment(user_id,news_id) {
    $('#new_commentaries').append('<input type="hidden" name="user_id" value="'+ user_id +'"/>');
    $('#new_commentaries').append('<input type="hidden" name="news_id" value="'+ news_id +'"/>');
    console.log(user_id, news_id);
    let data = $('#new_commentaries').serializeArray();
        $.ajax({
            url: window.BASE_DIR + `/news/addComment/`,
            data: data,
            type: "POST",
            dataType: "json",
            success: function(json){
                if (json.error > 0) {
                    alert('Ошибка удаления');
                } else {
                    //location.reload();
                }
            }
        })
}
