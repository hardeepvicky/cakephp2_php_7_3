//Ajax start
$(document).ajaxStart(function(){
    Loader.show();
});

//Ajax complete
$(document).ajaxComplete(function(){
    Loader.hide(); 
    Layout.fixContentHeight();
    App.initAjax();
});

$(document).ajaxError(function( event, jqxhr, settings, thrownError ) 
{
    Loader.hide();
    
    bootbox.alert(jqxhr.responseText);
    
    return;
});