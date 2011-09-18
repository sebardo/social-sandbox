<?php use_javascript(sfConfig::get('app_gmaps_js')) ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        if (GBrowserIsCompatible()) {
            var sendingPubication=false;
            var map = new GMap2(document.getElementById("map"));
            map.addControl(new GLargeMapControl());
            var point = new GLatLng(<?php echo $event->getLatitude(); ?>, <?php echo $event->getLongitude(); ?>);
            map.setCenter(point, 15);
            map.addOverlay(new GMarker(point));
            map.actualEvent=<?php echo $event->id; ?>;
            $('.publish').click(function(e){
                var me=this;
                var originalText=$(me).text();
                $(me).fadeTo('slow', 0.5).text('publishing...');
                e.preventDefault();
                if(!sendingPubication){
                    sendingPubication=true;
                    var user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
                    var dest_user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
                    var pub = map.actualEvent;
                    var model='event';
                    $.post('<?php echo url_for('wall/insertPub'); ?>',{user_id:user_id,dest_user_id:dest_user_id,pub:pub,model:model},function(){
                        $(me).text('Event publised').fadeTo(3000,1,function(){$(me).text(originalText)});
                        sendingPubication=false;
                    });
                }
            });
        }
    });
</script>



<div id="eventsContainer">
    <?php include_partial('event/links', array('event' => $event)); ?>
    <?php include_partial('event/show', array('event' => $event, 'display' => 'big', 'eventUser' => $eventUser)); ?>
</div>

