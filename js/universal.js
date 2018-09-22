$.fn.fragmentLoader=function(){
    var elem=this;
    $(elem).find('ul').children('li').on('click',function(){
        $(elem).find('ul').children('li').removeClass('active');
        $(this).addClass('active');
        var fragment=$(this).closest('ul').data('fragment');
        var module=fragment+'='+$(this).data(fragment);
        $('#'+fragment).ajaxReload(fragment,module);
    });
  }
$.fn.ajaxReload= function(url,data){
    var elem=this;
    $.ajax({
        url: "php-back/get"+url+".php",
        type: "POST",
        data: data,
        success: function(response){ 
            $(elem).html(response);
            //handle returned arrayList
        },
        error: function(e){  
            alert("error");
            //handle error
        } 
    });
} 