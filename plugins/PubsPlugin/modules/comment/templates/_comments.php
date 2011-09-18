<span>
    <i class="comment-count" style="float: none;margin: 0px;"></i>
    <?php echo __('Comments', null, 'pubs') ?>(<?php echo count($comments); ?>)
</span>

<div class="comments-items">
    <?php foreach ($comments as $comment): ?>  
        <?php include_partial('comment/comment', array('comment' => $comment, 'datos' => $datos)) ?>
    <?php endforeach; ?>
    <?php include_partial('comment/form', array('form' => $form, 'model' => $model)) ?>
</div>
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
    
    function insertComment(user_id,dest_user_id,record_model,record_id,comment,form){  
        $.get("/comment/insertComment?user_id="+user_id+"&dest_user_id="+dest_user_id+"&record_model="+record_model+"&record_id="+record_id+"&comment="+comment,
        function(data){    
            $(form).before(data);
        });
    } 
    
    
    $('.comments-items-form').find('textarea').unbind('keyup');
    $('.comments-items-form').find('textarea').keyup(function(e){  
        if(e.keyCode == 13)
        {
            var i = $(e.target);
            var form  = i.parent();
            var user_id = $(form).find('input[name=user_id]').val();
            var dest_user_id = $(form).find('input[name=dest_user_id]').val();
            var record_model = $(form).find('input[name=record_model]').val();
            var record_id = $(form).find('input[name=record_id]').val();
            var comment = i.val();
//            alert(comment.length)
            if(comment.length == 1){
                 i.val('');
            }
            if(comment.length > 1){
                i.val('');
                insertComment(user_id,dest_user_id,record_model,record_id,comment,form);
            }
           
        }
    });
</script>