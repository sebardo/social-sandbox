<link href="<?php echo sfConfig::get('app_base_url'); ?>sfFormExtraPlugin/css/jquery.autocompleter.css" media="screen" type="text/css" rel="stylesheet">
<script src="<?php echo sfConfig::get('app_base_url'); ?>sfFormExtraPlugin/js/jquery.autocompleter.js" type="text/javascript"></script>
<link href="<?php echo sfConfig::get('app_base_url'); ?>PubsPlugin/css/facebox.css" media="screen" type="text/css" rel="stylesheet">
<script src="<?php echo sfConfig::get('app_base_url'); ?>PubsPlugin/js/facebox.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function($) {
        
        
        $('#autocomplete_username').result(function(event, data, formatted){
            var string = data[0];
            var r = string.split("'");
            $('#autocomplete_username').val('');
            location = r[1];
        });

        $('.menu').click(function() {
            $('.menu-dropdown').toggle();
            if($('.menu').hasClass('open')){
                $('.menu').removeClass('open')
            }else{
                $('.menu').addClass('open');
            }
        });
        $('.count-button').click(function() {             
            if($(this).attr('rel') == 'pubs'){
                  $('#new-follows').hide();
                  $('.count-button[rel=follow]').removeClass('open')
                  $('#new-messages').hide();
                  $('.count-button[rel=inbox]').removeClass('open')
                  if($('#new-advices').css('display') == 'block')
                    $('#new-advices').slideUp('slow');
                else
                    $('#new-advices').slideDown('slow');
                
            }
            if($(this).attr('rel') == 'inbox'){
                $('#new-follows').hide();
                $('.count-button[rel=follow]').removeClass('open')
                $('#new-advices').hide();
                $('.count-button[rel=pubs]').removeClass('open')
                if($('#new-messages').css('display') == 'block')
                    $('#new-messages').slideUp('slow');
                else
                    $('#new-messages').slideDown('slow');
                
            }
            if($(this).attr('rel') == 'follow'){
                $('#new-messages').hide();
                $('.count-button[rel=inbox]').removeClass('open')
                $('#new-advices').hide();
                $('.count-button[rel=pubs]').removeClass('open')
                if($('#new-follows').css('display') == 'block')
                    $('#new-follows').slideUp('slow');
                else
                    $('#new-follows').slideDown('slow');
            }
                
            
            if($(this).hasClass('open')){
                $(this).removeClass('open')
            }else{
                $(this).addClass('open');
                if($(this).attr('rel') == 'pubs'){
                    $.get(base_url+"pubs/newAdvices",
                    function(data){    
                        $('#new-advices').html(data);
                        
                    });
                }
                if($(this).attr('rel') == 'inbox'){
                    $.get(base_url+"inbox/newMessages",
                    function(data){    
                        $('#new-messages').html(data);
                         
                      
                    });
                }
                if($(this).attr('rel') == 'follow'){
                    $.get(base_url+"follow/newFollowing",
                    function(data){    
                        $('#new-follows').html(data);
                        $.getScript('/PubsPlugin/js/newfollow.js');
                        
                    });
                }
               
            }
            
        });

        $('.stream-tab').click(function(e){
            e.preventDefault();
            //remueve todos los active
            var script = false;
            $('.stream-tab').removeClass('active');
            $('.stream-tab i').css('opacity','0.4');
            $('ul.pubs').html('');
            var yo = $(e.target);
            var url = yo.attr('rel');
            var script = yo.attr('script');
            
                
            
            $(this).addClass('active');
            yo.find('i').removeClass('flecha');
            yo.find('i').css('background-position','0px 0px');
            yo.find('i').css('opacity','1');
            yo.find('i').css('background-repeat','no-repeat');
            yo.find('i').css('background-image','url(/PubsPlugin/images/loading.gif)');
            
            
            $.get(base_url+url, function(info){     
                $('.pubs-list').show('slow').html(info);
                if(script == 'follow');
                $.get('/PubsPlugin/js/follow.js');
                
                yo.find('i').css('background-position','');
                yo.find('i').css('opacity','1');
                yo.find('i').css('background-repeat','');
                yo.find('i').css('background-image','');
                yo.find('i').addClass('flecha');
            });
        
        });
    });
    function goURL(url){
        location = (url);
    }
    function expandLink(div, url){
        $.get(base_url+'link/iframeExpand?url='+url, function(info){     
            $('#'+div).show('slow').html(info);
           
        });
    }
   
</script>
<div class="globalheader" id="globalheader">
    <?php echo image_tag('/PubsPlugin/images/logo_thumb.png','align=left border=0')?>
    <form method="GET" action="<?php echo sfConfig::get('app_base_url') ?>search" id="search-form" class="search-form">
        <span class="glass"></span>
        <?php echo $form['username']->render(array("size" => "40", "placeholder" => __("Search",null,'pubs'))) ?>
    </form>

    <?php if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) { ?>
        <?php include_component('follow', 'boxCount') ?>
    <?php } ?>

    <?php if (in_array('inbox', sfConfig::get('sf_enabled_modules', array()))) { ?>
        <?php include_component('inbox', 'boxCount') ?>
    <?php } ?>

    <?php if (in_array('pubs', sfConfig::get('sf_enabled_modules', array()))) { ?>
        <?php include_component('pubs', 'boxCount') ?>
    <?php } ?>
    <div class="tabs-header" onclick="goURL('/')"><?php echo __('Home', null, 'pubs') ?></div>
    <div class="tabs-header" onclick="goURL('/pubs')"><?php echo __('My Profile', null, 'pubs') ?></div>
    <div class="tabs-header" onclick="goURL('/search')"><?php echo __('Who to follow', null, 'pubs') ?></div>
    <ul class="nav secondary-nav">
        <li class="account">
            <a href="#" class="menu user-photo">
                <i></i>
                <span class="menu-label screen-name"><?php echo $sf_user->getGuardUser()->getUsername() ?> </span>
                <?php echo image_tag($sf_user->getGuardUser()->getImage(), 'width=40'); ?>

            </a>

            <ul class="menu-dropdown">
                <?php if (in_array('inbox', sfConfig::get('sf_enabled_modules', array()))) { ?>
                    <li><a id="inbox_link"  href="<?php echo url_for('@inbox') ?>"><?php echo __('Inbox', null, 'pubs') ?></a></li>
                <?php } ?>
                <?php if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) { ?>
                    <li><a id="follow_link"  href="<?php echo url_for('@follow') ?>"><?php echo __('Follows', null, 'pubs') ?></a></li>
                <?php } ?>
                <?php if (in_array('audio', sfConfig::get('sf_enabled_modules', array()))) { ?>
                    <li><a id="audio_link" accesskey="s" href="<?php echo url_for('@audio') ?>"><?php echo __('Audios', null, 'pubs') ?></a></li>
                <?php } ?>
                <?php if (in_array('event', sfConfig::get('sf_enabled_modules', array()))) { ?>
                    <li><a id="event_link" accesskey="s" href="<?php echo url_for('@event') ?>"><?php echo __('Events', null, 'pubs') ?></a></li>
                <?php } ?>
                <?php if (in_array('photo', sfConfig::get('sf_enabled_modules', array()))) { ?>
                    <li><a id="photo_link" accesskey="s" href="<?php echo url_for('@photo') ?>"><?php echo __('Photos', null, 'pubs') ?></a></li>
                <?php } ?>
                <li><a id="settings_link" accesskey="s" href="<?php echo url_for('settings', array('config' => 'basicinfo')); ?>"><?php echo __('Configuration', null, 'pubs') ?></a></li>
                
                <li><a id="help_link" accesskey="?" href="<?php echo url_for('@sf_guard_signout') ?>"><?php echo __('Logout', null, 'pubs') ?></a></li>
            </ul>
        </li>
    </ul>
</div>