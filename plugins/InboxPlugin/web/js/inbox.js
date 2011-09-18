$(document).bind('reveal.facebox', function(){
    $('#facebox').draggable();
})
$(document).ready(function($) {
    $('a[rel*=facebox]').unbind('keydown.facebox');
    $('a[rel*=facebox]').facebox();
    var mID =  $('.stream:eq(0)').attr('id');
    if(mID){
        $.get(base_url+"inbox/inboxRightAjax?messageID="+mID, function(info){
            $('.inbox_right').html(info);
        });
    } 
})