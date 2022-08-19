$(document).ready(function(){
    
    
    
    if($('head').append("<link href='/phpWorks/mvc1/app/views/indexcontroller/style.css?"+Math.floor(Math.random()*10000000) + 1+"' rel='stylesheet'/>")) {
        console.log("css live");
    }
    
})

