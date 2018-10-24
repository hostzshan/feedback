function triggersubmit(elem){
    $(elem).closest('form').submit();
}
$.fn.fragmentLoader=function(mode){
    var elem=this;
    $(elem).find('ul').children('li').on('click',function(){
        $(elem).find('ul').children('li').removeClass('active');
        $(this).addClass('active');
        var requester=$(this).closest('ul').data('requester');
        var fragment=$(this).closest('ul').data('fragment');
        var module=fragment+'='+$(this).data(fragment);
        $('#'+mode).ajaxReload("get",requester,module);
    });
  }
$.fn.ajaxReload= function(urltype,url,data){
    var elem=this;
    $.ajax({
        url: "php-back/"+urltype+url+".php",
        type: "POST",
        data: data,
        success: function(response){ 
            $(elem).html(response);
            //handle returned arrayList
        },
        error: function(e){  
            alert("Server error");
            //handle error
        } 
    });
}
$.fn.zform=function(){
    $(this).validator();
    $(this).on('submit',function(e) {
        var formid=$(this).attr('id');//get this form's id
        e.preventDefault(); // avoid to execute the actual submit of the form.
	    setTimeout(function(){ //wait 50ms to allow validator to execute
            // var data1=$("#"+formid).serialize()+"&flag"+formid+"=Y";
	        // alert($("#"+formid).find('.has-error').length);//No of errors in the form
            if($("#"+formid).find('.has-error').length==0) 
            {
                var data= $("#"+formid).serialize();
                $('#response').ajaxReload("submit",formid,data);
            }
        }, 50);
    });
}
$.fn.zformmultisubmit=function(){
    $(this).each(function(){
        var elem=this;
        $(elem).on('click',function(){
            var action=$(this).data('action');
            var parameter=$(this).data('parameter');
            // var args="";
            $(this).siblings('input,select').each(function(){
                var arg_name=$(this).data('name');
                var arg_value=$(this).val();
                // args+="&"+arg_name+"="+arg_value;
                // alert(args);
                $("#"+arg_name).val(arg_value);
            });
            // alert(parameter);
            var type=$(this).data('type');
            $("#type").val(type);
            $("#action").val(action);
            $("#parameter").val(parameter);
            $("#multiform").trigger('submit');
        });
    });
    
}
$.fn.zoption= function(){
    $(this).each(function(){
        var elem=this;
        $(elem).on('click',function(){
            var target=$(elem).data('target');
            // alert(target);
            $(target).toggle();
            
            // var fragment=$(this).closest('ul').data('fragment');
            // var module=fragment+'='+$(this).data(fragment);
            // $('#'+fragment).ajaxReload("get",fragment,module);
        });
    });
}
$(window).on('click',function(event){
    if($(event.target).closest(".z-optionbtn").length==0)
    {
      $(".z-optionbox").hide();
    }
  });

  $.fn.zprogressbar= function(good,average,max){
    $(this).each(function(){
        var elem=$(this).find('.progress-bar');
        var ratio=$(elem).data('ratio');
        // alert(ratio);
        $(elem).css('width',(ratio*100)+'%');
        $(elem).addClass('progress-bar-danger');
        var el=this;
        var x=1;
        setTimeout(function animcol(){
            var elem=$(el).find('.progress-bar');
            var foundratio=parseInt($(elem).css('width'))/parseInt($(el).css('width'));
            var percent=(foundratio*10).toFixed(2);
            $(elem).html(percent);
            var goodratio=good/max;
            var averageratio=average/max;
            // alert(foundratio+"="+goodratio);
            if($(elem).hasClass('error')){
                $(elem).removeClass('progress-bar-warning');
                $(elem).removeClass('progress-bar-info');
                $(elem).addClass('progress-bar-danger');
            }
            else if(foundratio>=goodratio){
                $(elem).removeClass('progress-bar-warning');
                $(elem).removeClass('progress-bar-danger');
                $(elem).addClass('progress-bar-info');
            }
            else if(foundratio>=averageratio){
                $(elem).removeClass('progress-bar-info');
                $(elem).removeClass('progress-bar-danger');
                $(elem).addClass('progress-bar-warning');
            }
            x*=1.2;
            if(x<120)
                setTimeout(animcol,x);
            else
                final(el,goodratio,averageratio);
        },x);
    });
}
function final(el,goodratio,averageratio){
    var elem=$(el).find('.progress-bar');
    var ratio=$(elem).data('ratio');
    // alert(ratio);
    var percent=(ratio*10).toFixed(2);
    $(elem).html(percent);
    if(ratio>=goodratio){
        $(elem).removeClass('progress-bar-warning');
        $(elem).removeClass('progress-bar-danger');
        $(elem).addClass('progress-bar-info');
    }
    else if(ratio>=averageratio){
        $(elem).removeClass('progress-bar-info');
        $(elem).removeClass('progress-bar-danger');
        $(elem).addClass('progress-bar-warning');
    }
}