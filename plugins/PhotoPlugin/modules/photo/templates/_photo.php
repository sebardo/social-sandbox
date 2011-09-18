<li rel="<?php echo $photo->getId();?>" class="photo ui-state-default">
    <ul class="icons" rel="<?php echo $photo->getId(); ?>">
        <li class="options ui-icon ui-icon-circle-triangle-s" title="Options">
            <ul>
                <?php if ($photo->isMine()):?>
                <li class="delete"><?php echo __('Delete', null, 'photo')?></li>
                <li class="setCover"><?php echo __('Select as cover', null, 'photo')?></li>
                <li class="setProfilePhoto"><?php echo __('Select as profile photo', null, 'photo')?></li>
                <li class="edit"><a href="<?php echo url_for('photo/edit?id='.$photo->getId());?>"><?php echo __('Edit', null, 'photo')?></a></li>
                <?php endif; ?>
                <li><a href="<?php echo url_for('photo/show?id='.$photo->getId());?>"><?php echo __('show', null, 'photo')?></a></li>
            </ul>
        </li>
        <li class="handlerMove ui-icon ui-icon-grip-dotted-horizontal" title="move"></li>
    </ul>
    <a href="<?php echo $photo->getLink('big');?>" title="<?php echo $photo->getTitle();?>" class="galery" rel="gal1">
        <?php echo image_tag($photo->getThumb(100,100,'thumb'),'title='.$photo->getTitle().' alt='.$photo->getTitle());?>
    </a>
</li>

