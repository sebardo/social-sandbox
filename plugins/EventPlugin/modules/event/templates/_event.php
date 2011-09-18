<?php use_helper('Date'); ?>
<div class="marker" rel="<?php echo $event->id; ?>">
    <div><strong><?php echo link_to($event->name, url_for('event/show?id=' . $event->id)); ?></strong></div>
    <div class="content">

        <?php if ($event->image != ''): ?>
            <div class="imageEvent"><?php echo image_tag($event->getImagePath()); ?></div>
        <?php endif; ?>

        <div class="infoEvent"<?php if ($event->image == ''): ?> style="width: auto;margin-left: inherit;"<?php endif; ?>>
            <strong><?php echo __('Date:', null, 'event') ?> </strong><?php echo format_date($event->date, "D", 'es') ?><br/>
            <strong><?php echo __('Time:', null, 'event') ?> </strong><?php echo $event->hour; ?><br/>
            <strong><?php echo __('Address:', null, 'event') ?> </strong><?php echo $event->address; ?><br/>
        </div>
    </div>
</div>