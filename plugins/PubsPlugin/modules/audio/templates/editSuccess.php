<?php include_javascripts(); ?>
<?php include_stylesheets(); ?>
<script type="text/javascript" src="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/js/jquery.jplayer.min.js"></script>
    
<script>
    jQuery(document).ready(function($) {
        $('#facebox',window.parent.document).animate({height:'150px'}, 500);
        $('.pop_up',window.parent.document).animate({height:'150px'}, 500);
        $('.content',window.parent.document).animate({height:'150px'}, 500);
        $('.iframeNewAudioSuccess',window.parent.document).animate({height:'150px'}, 500);
    });
</script>
<div class="content-audio">
    <?php $obj = $form->getObject(); ?>
    <?php include_component('audio', 'audio', array('id' => $obj->getId())) ?>
    <?php include_partial('form', array('form' => $form, 'duid' => $duid, 'audio' => $sf_request->getParameter('audio'))) ?>
</div>
