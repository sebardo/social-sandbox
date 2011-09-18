
<?php use_helper('Date'); ?>
<?php $display = isset($display) ? $display : false; ?>
<div id="mapContainer">
    <div id="map" style="width: 400px;height:300px;"></div>
    <div id="eventDescription">

        <?php if ($event->exists()): ?>

            <?php if ($display == 'big'): ?>
                <h2><?php echo $event->name; ?></h2>
                <p>
                    <strong><?php echo __('Date:', null, 'event') ?> </strong><?php echo format_date($event->date, "D", 'es') ?><br/>
                    <strong><?php echo __('Time:', null, 'event') ?> </strong><?php echo $event->hour; ?><br/>
                    <strong><?php echo __('Address:', null, 'event') ?> </strong><?php echo $event->address; ?><br/>
                </p>
                <p>
                    <?php if ($event->image != ''): ?>
                        <?php echo image_tag($event->getImagePath('medium'), array('class' => 'imageInP')); ?>
                    <?php endif; ?>

                    <?php echo $event->description; ?>
                </p>
            <?php else: ?>
                <?php include_partial('event/event', array('event' => $event)); ?>
                <p>
                    <?php echo $event->description; ?>
                </p>
            <?php endif; ?>
        <?php else: ?>
            <p><?php echo __("There's no event to show", null, 'event') ?></p>
        <?php endif; ?>


    </div>
    <div style="clear:both;"></div>
</div>

<?php if (sfConfig::get('app_event_favlikeable') && sfContext::getInstance()->getActionName() == 'show') : ?>
<style>
#eventsContainer {
    border-radius: 0;
    box-shadow: none;
    margin: 18px auto;
    position: relative;
    width: 980px;
}
</style>    
    <?php include_component('favlike', 'favlikes', array('object' => $event, 'model' => 'event')) ?>
<?php endif; ?>
<?php if (sfConfig::get('app_event_commentable') && sfContext::getInstance()->getActionName() == 'show') : ?>
    <?php include_component('comment', 'comments', array('object' => $event, 'model' => 'event', 'datos' => $event->getUser())) ?>
<?php endif; ?>

