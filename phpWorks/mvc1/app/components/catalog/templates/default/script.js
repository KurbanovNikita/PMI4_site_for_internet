function getShowFormByID(id) {
    $.ajax({
        url: window.BASE_DIR + `/products/getShowFormByID/${id}/`,
        type: "POST",
        dataType: "html",
        success: function(html){
            $('div.main').append(html);
            $('#show_products_modal').on('hidden.bs.modal', function (e) {
                $(e.target).remove();
            })
            $('#show_products_modal').modal('show');

        }
    })
        
}

function showProductsBySection($sec_id){
    console.log($sec_id);
    if ($sec_id == "lol") {
        location.reload();
    } else {
       $.ajax({
            url: window.BASE_DIR + `/products/getProductsBySection/${$sec_id}/`,
            type: "POST",
            dataType: "html",
            success: function(html){
                $('div.products_catalog').remove();//innerHTML(html);
                $('div.main').append(html);//innerHTML(html);
            }
        }) 
    }
    
}

