<script language="javascript">
    $(document).bind('reveal.facebox', function(){
        $('#facebox').draggable();
    })
</script>
<script>
    $(document).ready(function($) {
        
        $('#loading').hide();
        
        $('a[rel*=delete]').unbind('keydown.facebox');
        $('a[rel*=delete]').facebox();
       

        $('.favlike-item').unbind();
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
       
        
        $('.morePager').unbind();
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
    function showLast(id){
        $.get(base_url+"pubs/showLastPub?id="+id,
        function(data){    
            $('.top-center-pubs').after(data);
        });
    }
    
         
</script>
<script type="text/javascript" src="<?php echo sfConfig::get('app_base_url') ?>/PubsPlugin/js/jquery.jplayer.min.js"></script>

<div id="pubsContainer">
    <div id="follow_left" class="follow_left">
        <div class="profile-header">
            <?php include_partial('favlike/favlike_profile_header', array('datos' => $datos)) ?>
        </div>
        <div class="follower_container">
            <?php include_partial('list', array('favlikes' => $favlikes, 'datos' => $datos)) ?>
        </div>
    </div>

    <div id="follow_right" class="follow_right">
        <div class="component">
            <?php include_component("pubs", "component_data_profile", array('datos' => $datos)); ?>
        </div>
        <div class="component">
            <?php include_component('follow', 'followHomeComponent', array('datos' => $datos)) ?>
        </div>
    </div>
</div>

