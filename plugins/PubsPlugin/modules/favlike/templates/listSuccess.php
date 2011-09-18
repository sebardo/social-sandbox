<script language="javascript">
    $(document).bind('reveal.facebox', function(){
        $('#facebox').draggable();
    })
</script>
<script>
    $(document).ready(function($) {
   
        $('a[rel*=delete]').unbind('keydown.facebox');
        $('a[rel*=delete]').facebox();
        
        function insertComment(user_id,dest_user_id,record_model,record_id,comment,form){  
            $.get(base_url+"comment/insertComment?user_id="+user_id+"&dest_user_id="+dest_user_id+"&record_model="+record_model+"&record_id="+record_id+"&comment="+comment,
            function(data){    
                $(form).before(data);
            });
        } 
        $('.comments-items-form').unbind();
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
                i.val('');
                insertComment(user_id,dest_user_id,record_model,record_id,comment,form);
            }
        });
       
    });        
</script>
<?php include_partial('list', array('favlikes' => $favlikes, 'datos' => $datos)) ?>
