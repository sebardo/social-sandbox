<?php 
$title = $amountPhotos > 0 ? $album->getName() : __('No photos to show', null, 'photo');
$autor =$isMIne? __('Your photos', null, 'photo'):__('Photos', null, 'photo') .' '.__('by', null, 'photo') .' '. ($user->getName()!=''?$user->getName():$user->getUsername());
;?>
<h3><span class="title" rel="<?php echo $album->getId();?>"><?php echo $title;?></span> (<span class="amountPhotos"><?php echo $amountPhotos;?></span>)</h3>
<?php if(!$isGalery){echo link_to($autor, 'photo/index?user='.$user->getId());}?>

<?php if($isMine):?>

    <div id="tools">
        <a href="<?php echo url_for('photo/new?album='.$album->getId());?>" id="addPhoto"><?php echo __('Add Photos', null, 'photo')?></a>
        <?php $up = __('Upload in new album', null, 'photo')?>
        <?php if($isGalery){echo link_to($up, 'photo/new','id=addPhoto2');}?>
        <div id="contFormPhoto" rel="<?php echo $album->getId();?>">
            <?php include_partial('photo/form',array('form'=>$form));?>
        </div>
    </div>

<?php endif;?>

<ul id="sortablePhoto" rel="<?php echo $album->getId();?>">
    <?php if (isset($photos)) {
        if (count($photos) > 0) {
            foreach ($photos as $photo) {
                include_partial('photo/photo',array('photo'=>$photo,'user'=>$user));
            }
        }
    }?>
</ul>
<div style="clear: both"></div>