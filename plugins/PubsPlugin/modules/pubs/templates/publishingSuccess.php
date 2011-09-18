<script src="<?php echo sfConfig::get('app_base_url'); ?>sfDoctrineGuardPlugin/js/jquery-1.6.1.js" type="text/javascript"></script>
<script src="<?php echo sfConfig::get('app_base_url'); ?>PubsPlugin/js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#facebox',window.parent.document).animate({height:'40px'}, 500);
        $('.pop_up',window.parent.document).animate({height:'40px'}, 500);
        $('.content',window.parent.document).animate({height:'40px'}, 500);
        $('#facebox',window.parent.document).find('iframe',window.parent.document).animate({height:'40px'}, 500);
        $('.iframeNewAudioSuccess',window.parent.document).animate({height:'40px'}, 500);
        $('#facebox',window.parent.document).find('#loading',window.parent.document).hide();
        if($(parent.document).find('#facebox').css('display') == 'none' ){
            $('#audioFrame',window.parent.document).delay(1500).fadeOut(function() {
                parent.remove('audioFrame');
            });
           
        }
        parent.showLast('<?php echo $pub->getId() ?>');

        $('#facebox',window.parent.document).delay(1500).fadeOut(function() {
            $('#facebox .loading',window.parent.document).remove()
            $("#facebox_overlay",window.parent.document).remove()
            $(document,window.parent.document).trigger('afterClose.facebox')
        })

    });
    function remove(id){
        parent.remove(id);
    }
</script>
<style>
    body{
        font: 13.34px helvetica,arial,freesans,clean,sans-serif;
        margin: 0;
        margin-top: 10px;
    }
    body i{
        background-image: url("/PubsPlugin/images/sprite-icons.png");
        background-position: -141px -304px;
        display: inline-block;
        height: 13px;
        margin-left: 10px;
        width: 18px;
    }
    
</style>
<?php echo __('Published Successfully', null, 'pubs') ?><i></i>
