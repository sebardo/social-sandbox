<script>
    jQuery(document).ready(function($) {
        $('#loading').hide();
        
        $('a[rel*=delete]').unbind('click.facebox');
        $('a[rel*=delete]').facebox();
        
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
        
        $('.morePager').unbind('click');
        $('.morePager').click(function(e){
            var i = $(e.target);
            $('#loading-list').show();
            var div_id = i.attr('div-id');           
            var user_id = i.attr('user-id');       
            var page = i.attr('page'); 
            $.get(base_url+"pubs/listAjaxMorePage?user_id="+user_id+"&page="+page,
            function(data){
                i.hide();
                $('#'+div_id).html(data);
            });
            
        });
 
        function insertComment(user_id,dest_user_id,record_model,record_id,comment,form){  
            $.get(base_url+"comment/insertComment?user_id="+user_id+"&dest_user_id="+dest_user_id+"&record_model="+record_model+"&record_id="+record_id+"&comment="+comment,
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
                i.val('');
                insertComment(user_id,dest_user_id,record_model,record_id,comment,form);
            }
        });
    });
</script>
<?php foreach ($pager->getResults() as $pub): ?>

    <?php include_partial('pubs/pub', array('pubs' => $pub, 'datos' => $datos)) ?>

<?php endforeach; ?>
<?php if (count($pager) > 10) { ?>
    <div div-id="morePager-<?php echo time() ?>" user-id="<?php echo $datos->getId() ?>" page="<?php echo ($sf_request->getParameter('page')+1) ?>" class="morePager">
        Previous publication  <?php echo image_tag('/PubsPlugin/images/loading.gif', "id=loading-list") ?>
    </div>
    <div id="morePager-<?php echo time() ?>"></div>
<?php } ?> 
