$(document).ready(function(){                       
    $('.stream').click(function() {
        $('#loading').show();
        var messageID = $(this).attr('id');
        $.get(base_url+"inbox/inboxRightAjax?messageID="+messageID, function(info){
            $('.inbox_right').html(info);
            $('#loading').hide();
        });

    });     
}); 