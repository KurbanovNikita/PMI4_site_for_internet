function showNewsByID(id) {
    console.log(id);
    $.ajax({
        url: window.BASE_DIR + `/news/showNewsByID/${id}/`,
        type: "POST",
        dataType: "json",
        success: function(data){
            window.location.replace(window.BASE_DIR + "/news?" + id);
            
        }
    })
        
}

function showNewsByCategory($cat_id){
    if ($cat_id == "lol") {
        location.reload();
    } else {
       $.ajax({
            url: window.BASE_DIR + `/news/showNewsByCategory/${$cat_id}/`,
            type: "POST",
            dataType: "html",
            success: function(html){
                $('div.news_publications').remove();//innerHTML(html);
                $('div.main').append(html);//innerHTML(html);
            }
        }) 
    }
    
}

