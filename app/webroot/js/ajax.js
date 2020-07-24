//Ajax start
$(document).ajaxStart(function(){
    $("body").trigger("sr-loader.show");
});

//Ajax complete
$(document).ajaxComplete(function(){
    $("body").trigger("sr-loader.hide");
    Layout.fixContentHeight();
    App.initAjax();
});

$(document).ajaxError(function( event, jqxhr, settings, thrownError ) 
{
    $("body").trigger("sr-loader.hide");
    bootbox.alert(jqxhr.responseText);    
    return;
});