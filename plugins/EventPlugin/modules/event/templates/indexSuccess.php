<?php use_javascript(sfConfig::get('app_gmaps_js')) ?>
<?php use_javascript('/EventPlugin/js/dragzoom.js'); ?>
<?php use_javascript('/EventPlugin/js/GMapDriver.js'); ?>
<?php use_helper('Date'); ?>
<?php use_helper('Text'); ?>

<script type="text/javascript">
    var events = <?php echo htmlspecialchars_decode($events->exportTo('json')) ?>;
    jQuery(document).ready(function() {
        var sendingPubication=false;
        var mapa = new GMapDriver('map');
        mapa.descriptionContainer='eventDescription';
        mapa.loadMap(events);
        mapa.urls.searchNear='<?php echo url_for('event/searchNear'); ?>';
        mapa.filterParams=[];

<?php if (sfContext::getInstance()->getActionName() == 'list' && $userId): ?>
            mapa.filterParams['user_id']=<?php echo $userId; ?>;
<?php endif; ?>
    
<?php if (count($events) > 0): ?>
            mapa.actualEvent=<?php echo $events[0]->id; ?>;
<?php endif; ?>
        $('.publish').click(function(e){
            var me=this;
            var originalText=$(me).text();
            $(me).fadeTo('slow', 0.5).text('publishing...');
            e.preventDefault();
            if(!sendingPubication){
                sendingPubication=true;
                var user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
                var dest_user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
                var pub = mapa.actualEvent;
                var model='event';
                $.post('<?php echo url_for('wall/insertPub'); ?>',{user_id:user_id,dest_user_id:dest_user_id,pub:pub,model:model},function(){
                    $(me).text('Event publised').fadeTo(3000,1,function(){$(me).text(originalText)});
                    sendingPubication=false;
                });
            }
        });
    });
</script>
<div id="eventsContainer">

    <?php include_partial('event/links'); ?>
    <div class="messages-header header">
        <h1><?php echo $titulo; ?></h1>
    </div>
    <div style="margin: 10px;overflow: hidden;padding-bottom: 10px;">

        <div class="eventsContainer">
            <?php include_partial('event/list', array('events' => $events)); ?>
        </div>
    </div>
    <div style="clear:both;"></div>
    <?php include_partial('event/show', array('event' => $events[0])); ?>
</div>