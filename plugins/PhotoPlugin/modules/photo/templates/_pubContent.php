<?php if($pub != ''){?>
<div><?php echo link_to($photo->getPubText($pub), 'photo/show?id=' . $photo->getId()); ?></div>
<?php }?>
<div class="contPubPhoto" style="float:left">
    <?php echo link_to(image_tag($photo->getThumb(100, 100, 'thumb')), 'photo/show?id=' . $photo->getId()); ?>
</div>
<div style="float:left; padding: 5px;"><b>
<?php echo $photo->getTitle()?>
</b></div>