<?php if ($album->getName() == sfConfig::get('app_profile_album_name')): ?>
    <div><?php echo link_to($album->isMine() ? 'Haz actualizado tu foto de perfil' : $album->getUser()->getName() . ' ha actualizado su foto de perfil', 'album/show?id=' . $album->getId()); ?></div>
    <div class="contPubPhoto">
    <?php echo link_to(image_tag($album->getUser()->getImage(100, 100, 'thumb')), 'album/show?id=' . $album->getId()); ?>
    </div>
<?php else: ?>
        <div>Se ha actualizado el album <?php echo link_to($album->getName(), 'album/show?id=' . $album->getId()); ?></div>
        <div class="contPubPhoto">
    <?php
        foreach ($photos as $photo) {
            echo link_to(image_tag($photo->getThumb(100, 100, 'thumb')), 'album/show?id=' . $photo->getAlbum()->getId());
        }
    ?>
    </div>
    <div><?php echo link_to($album->getName(), 'album/show?id=' . $album->getId()); ?></div>
<?php endif; ?>