<li class="album  ui-state-default" rel="<?php echo $album->getId(); ?>">
    <ul class="icons" rel="<?php echo $album->getId(); ?>">
        <li class="options ui-icon ui-icon-circle-triangle-s" title="Options">
            <ul>
                <?php if ($album->isMine()):?>
                <li class="delete">Delete</li>
                <?php endif; ?>
                <li class="show"><a href="<?php echo url_for('album/show?id='.$album->getId());?>">show</a></li>
            </ul>
        </li>
        <li class="handlerMove ui-icon ui-icon-grip-dotted-horizontal" title="move"></li>
    </ul>
    <span class="cover"><?php echo image_tag($album->getCover('thumb')); ?></span>
    <span class="title"><?php echo $album->getName(); ?></span>
</li>
