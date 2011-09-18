<?php use_helper("Date"); ?>
<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/facebox.js') ?>
<?php use_stylesheet(sfConfig::get('app_base_url') . 'PubsPlugin/css/facebox.css') ?>
<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/jquery.jeditable.js') ?>
<script type="text/javascript">
    $(document).ready(function($) {
        
        $('a[rel*=delete]').facebox();  
    
        $(".new_audio").click(function() {
            
            if($('#audioFrame').length == 0){
                var testFrame = document.createElement("IFRAME");
                testFrame.id = "audioFrame";
                testFrame.src = base_url+"audio/new?duid=<?php echo $sf_user->getGuardUser()->getId() ?>";
                document.body.appendChild(testFrame);
                $('#audio-header').after(testFrame);
                $('#audioFrame').addClass("iframeNewAudioSuccess");
                $('#audioFrame').delay(1500).show();
            }else{
                $('#audioFrame').remove();
            }
        });
        
        $(".songName").editable('<?php echo sfConfig::get('app_base_url') ?>audio/editName', {
            indicator : "Saving...",
            tooltip   : "Click to edit...",
            onblur    : 'submit',
            submitdata : function(value, settings) {
                       
                if($(this).debugMode)console.info('Edit audio name ... ');
                return {
                          
                };
            }
        });
        $(".songDescription").editable('<?php echo sfConfig::get('app_base_url') ?>audio/editDesc', {
            indicator : "Saving...",
            tooltip   : "Click to edit...",
            onblur    : 'submit',
            submitdata : function(value, settings) {
                       
                if($(this).debugMode)console.info('Edit audio description ... ');
                return {
                          
                };
            }
        });
        $(".listName").editable('<?php echo sfConfig::get('app_base_url') ?>audio/editListName', {
            indicator : "Saving...",
            tooltip   : "Click to edit...",
            onblur    : 'submit',
            submitdata : function(value, settings) {
                       
                if($(this).debugMode)console.info('Edit list name ... ');
                return {
                          
                };
            }
        });
        $(".view_pl").click(function() {
            var id = $(this).attr('id');
            $('#playlist_'+id).toggle("slow");
        });
    });
    
    function showLast(id){
        $.get(base_url+"audio/showLast?id="+id,
        function(data){    
            $('#songItemList_000000').after(data);
        });
    }
    
    function remove(id){
        $('#'+id).remove();
    }
</script>
<div id="audioContainer">
    <div class="audio_left">
        <div class="image_user_audio" align="center">
            <?php echo image_tag($datos->getImage('240', '240', 'big'), 'width=240'); ?>
        </div>
        <?php if ($sf_request->getParameter('aid')) { ?>
            <?php $audio = Doctrine::getTable('Audio')->findBy('id', $sf_request->getParameter('aid')); ?>
            <?php include_component('audio', 'audio_component', array('datos' => $datos, 'audios' => $audio, 'playlists' => $playlists)); ?>
        <?php } else { ?>
            <?php include_component('audio', 'audio_component', array('datos' => $datos, 'audios' => $audios, 'playlists' => $playlists)); ?>
        <?php } ?>
    </div>
    <div class="audio_right">
        <?php if ($sf_request->getParameter('aid')) { ?>
            <?php $a = Doctrine::getTable('Audio')->find($sf_request->getParameter('aid')); ?>
            <?php if (sfConfig::get('app_audio_favlikeable')) : ?>
                <?php include_component('favlike', 'favlikes', array('object' => $a, 'model' => 'audio')) ?>
            <?php endif; ?>
            <?php if (sfConfig::get('app_audio_commentable')) : ?>
                <?php include_component('comment', 'comments', array('object' => $a, 'model' => 'audio', 'datos' => $datos)) ?>
            <?php endif; ?>
        <?php } ?>
        <div id="audio-header">
            <h1><?php echo __('Audios', null, 'audio') ?> <?php echo $sf_user->getGuardUser()->getUsername() ?></h1>
            <a  class="button new_audio"  href="#">
                <span class="add-audio"></span>
                <em style="" class="wrapper">
                    <b><?php echo __('New Audio', null, 'audio') ?></b>
                </em>
            </a>
            <span id="loading" style="display: none"><?php echo image_tag(sfConfig::get('app_base_url') . '/PubsPlugin/images/loading.gif') ?></span>&nbsp;&nbsp;
        </div>
        <iframe style="display: none" frameborder="0" src="<?php echo sfConfig::get('app_base_url'); ?>audio/new?duid=<?php echo $datos->getId() ?>&audio=1" class="iframeNewAudioSuccess"></iframe>

        <?php include_partial('list', array('datos' => $datos, 'audios' => $audios)) ?>
        <br/>&nbsp;<br/>
        <h1><?php echo __('List', null, 'audio') ?> <?php echo $sf_user->getGuardUser()->getUsername() ?></h1>
        <?php include_partial('list_playlist', array('playlists' => $playlists)) ?>
    </div>
</div>
