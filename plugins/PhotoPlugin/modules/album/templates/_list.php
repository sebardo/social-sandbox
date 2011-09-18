<?php
$isMyGalery = $sesionUserId == $user->getId();
$title = $isMyGalery ? __('My albums', null, 'photo') : __('Albums by', null, 'photo') .' '. ($user->getName()!=''?$user->getName():$user->getUsername());
?>
<h3><?php echo $title; ?>(<span class="amountAlbums"><?php echo $amountAlbums; ?></span>)</h3>
<div id="herramientas">

</div>
<ul id="sortableAlbum">
    <?php
    if (count($albums) > 0) {
        foreach ($albums as $album) {
            include_partial('album/album', array('album' => $album, 'user' => $user));
        }
    }
    ?>
</ul>
<div style="clear: both"></div>