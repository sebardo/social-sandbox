<?php include_partial('comment/comment', array('comment' => $comment, 'datos' => $datos)) ?>

<script>
    $('a[rel=delete]').unbind('click.facebox'); 
    $('a[rel=delete]').facebox();
    
    $('.favlike-item').unbind('click');
    $('.favlike-item').click(function(e){
        var yo = $(e.target);
        yo.parent().find('i.favlike').css('background-position','0px 0px');
        yo.parent().find('i.favlike').css('background-repeat','no-repeat');
        yo.parent().find('i.favlike').css('background-image','url(/PubsPlugin/images/loading.gif)');
            
        $.get(yo.attr('data'),
        function(data){
            $('#'+yo.attr('id')).text(data); 
            yo.parent().find('i.favlike').css('background-position','-320px -112px');
            yo.parent().find('i.favlike').css('background-image','url(/PubsPlugin/images/sprite-icons.png)');
            
        });
    });
</script>