<?php use_helper('Date'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var urls={};
        var selectors={};
        var params={};
        var photo;
        var traduction={};

        urls.base=            '<?php echo sfConfig::get('app_base_url'); ?>';
        urls.list=            '<?php echo url_for('photo/list'); ?>';
        urls.deleteAlbum=     '<?php echo url_for('album/delete'); ?>';
        urls.showAlbum=       '<?php echo url_for('album/show'); ?>';
        urls.showPhoto=       '<?php echo url_for('photo/show'); ?>';
        urls.editPhoto=       '<?php echo url_for('photo/edit'); ?>';
        urls.setProfilePhoto= '<?php echo url_for('photo/setProfilePhoto'); ?>';
        urls.getPhoto=        '<?php echo url_for('photo/getPhoto'); ?>';
        urls.tagPhoto=        '<?php echo url_for('photo/tagPhoto'); ?>';
        urls.deleteTag=       '<?php echo url_for('photo/deleteTag'); ?>';
        urls.getTags=         '<?php echo url_for('photo/getTags'); ?>';
        urls.deletePhoto=     '<?php echo url_for('photo/delete'); ?>';
        urls.editTitlePhoto=  '<?php echo url_for('photo/editTitle'); ?>';
        urls.editCoors=       '<?php echo url_for('photo/editCoors'); ?>';
        urls.setCover=        '<?php echo url_for('photo/setCover'); ?>';
        urls.thumb=           '<?php echo url_for('photo/thumb'); ?>';
        
        traduction.frase1 =   '<?php echo __('There is no album where you upload pictures create a new', null, 'photo')?>'
        traduction.frase2 =   '<?php echo __('Load the image in the album', null, 'photo')?>'
        traduction.frase3 =   '<?php echo __('Load the image in the new album', null, 'photo')?>'
        traduction.frase4 =   '<?php echo __('Start a default album', null, 'photo')?>'
        traduction.frase5 =   '<?php echo __('Search album', null, 'photo')?>'
        traduction.frase6 =   '<?php echo __('Starting album', null, 'photo')?>'
        traduction.frase7 =   '<?php echo __('No album selected', null, 'photo')?>'
        traduction.frase8 =   '<?php echo __('Rel attribute is changed with title ', null, 'photo')?>'
        traduction.frase9 =   '<?php echo __(' to ', null, 'photo')?>'
        traduction.frase10 =   "<?php echo __("Don't load album because the album selected is: ", null, "photo")?>"
        traduction.frase11 =   '<?php echo __(' and are trying to upload is ', null, 'photo')?>'
        traduction.frase12 =   '<?php echo __('Editing the title of the album', null, 'photo')?>'
        traduction.frase13 =   '<?php echo __('New order:', null, 'photo')?>'
        traduction.frase14 =   "<?php echo __("You've moved the image ", null, 'photo')?>"
        traduction.frase15 =   '<?php echo __(' to the album ', null, 'photo')?>'
        traduction.frase16 =   '<?php echo __('assigning albums', null, 'photo')?>'
        traduction.frase17 =   '<?php echo __('listing albums', null, 'photo')?>'
        traduction.frase18 =   '<?php echo __('listing images', null, 'photo')?>'
        traduction.frase19 =   '<?php echo __('No images to show', null, 'photo')?>'
        traduction.frase20 =   '<?php echo __('loading...', null, 'photo')?>'
        traduction.frase21 =   '<?php echo __('Click to edit...', null, 'photo')?>'
        traduction.frase22 =   '<?php echo __('Delete', null, 'photo')?>'
        traduction.frase23 =   '<?php echo __('Select as cover', null, 'photo')?>'
        traduction.frase24 =   '<?php echo __('Select as profile photo', null, 'photo')?>'
        traduction.frase25 =   '<?php echo __('Edit', null, 'photo')?>'
        traduction.frase26 =   '<?php echo __('Show', null, 'photo')?>'
        traduction.frase27 =   '<?php echo __('Add title', null, 'photo')?>'
        traduction.frase28 =   '<?php echo __('Cancel', null, 'photo')?>'
        traduction.frase29 =   '<?php echo __('Save', null, 'photo')?>'
        traduction.frase30 =   '<?php echo __('(delete)', null, 'photo')?>'
        traduction.frase31 =   '<?php echo __('The following errors were found:', null, 'photo')?>'
        traduction.frase32 =   '<?php echo __('No area to tag', null, 'photo')?>'
        traduction.frase33 =   "<?php echo __("There's no name for the tag", null, 'photo')?>"
        traduction.frase34 =   '<?php echo __('assigning images the album', null, 'photo')?>'
        traduction.frase35 =   '<?php echo __('asignando como caratula', null, 'photo')?>'
        
        selectors.photo=         '.photo';
        selectors.cover=         '.cover';
        selectors.title=         '.title';
        selectors.tagPhoto=      '.tagPhoto';

        params.urls=             urls;
        params.traduction=       traduction;
        params.selectors=        selectors;
        params.userId=           '<?php echo $sf_user->getGuardUser()->getId(); ?>';
        params.albumUserId=      '<?php echo $user->getId(); ?>';

        var photoId=            '<?php echo $photo->getId(); ?>';
        $.post(urls.getPhoto,{
            photoId:photoId
        },
        function(result){
            photo=new Photo(result.Photos[0],params,result.User);
            photo.init('<?php echo $photo->getId(); ?>');
        });
    });
</script>
<div id="contPhoto" rel="<?php echo $photo->getId(); ?>">
    <div id="seekPhoto">
        <span class="right button"><a href="<?php echo url_for('photo/show?id=' . $photo->getNext()); ?>"><?php echo __('Next', null, 'photo')?></a></span>
        <span class="left button"><a href="<?php echo url_for('photo/show?id=' . $photo->getPrev()); ?>"><?php echo __('Previous', null, 'photo')?></a></span>
    </div>
    <div id="viewer">
        <?php echo link_to(image_tag('../' . $photo->getLink('big'), 'title=' . $photo->getTitle() . ' alt=' . $photo->getTitle() . ' id=photo' . $photo->getId()), 'photo/show?id=' . $photo->getNext()); ?>
        <?php //echo image_tag('../'.$photo->getLink('big'),'title='.$photo->getTitle().' alt='.$photo->getTitle().' id=photo'.$photo->getId());?>
    </div>

</div>
<div id="footPhoto">
    <div id="photoLeft">
        <div id="info">
            <p>
                <?php echo link_to($album->getName(), url_for('album/show?id=' . $album->getId())); ?><br />
                <?php echo __('By', null, 'photo')?> <?php echo link_to(($photo->isMine()) ? __('me', null, 'photo') : ($user['name']!=''?$user['name']:$user['username']), url_for('pubs/index?user=' . $user['username'])); ?>
                (<?php echo link_to(($photo->isMine()) ? __('My photos', null, 'photo') : __('Photos', null, 'photo'), url_for('photo/index?user=' . $user['id'], true)); ?>)
                &bull; <?php echo $photo->getMyOrd(); ?> / <?php echo $album->amountPhotos(); ?>
            </p>
        </div>
        <?php if ($photo->isMine()): ?>
            <div id="options" rel="<?php echo $photo->getId(); ?>">
                <ul>
                    <li><a href="#" class="setProfilePhoto"><?php echo __('Select as profile photo', null, 'photo')?></a></li>
                    <li><a href="#" class="setCover"><?php echo __('Select as cover', null, 'photo')?></a></li>
                    <li><a href="#" class="edit"><?php echo __('Edit', null, 'photo')?></a></li>
                    <li><a href="#" class="delete"><?php echo __('Delete', null, 'photo')?></a></li>
                    <li><a href="#" class="tagPhoto"><?php echo __('Tag this photo', null, 'photo')?></a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div id="photoCenter">
        <div id="tags">
            <?php if (count($photo->Tags) > 0): ?>
                In this photo:<br />
            <?php endif; ?>
            <?php foreach ($photo->Tags as $tag): ?>
                <span class="tag" rel="<?php echo $tag->getId(); ?>">&bull;<?php echo $tag; ?>&nbsp;
                    <?php if ($photo->isMine()): ?>
                        <span class="deleteTag" rel="<?php echo $tag->getId(); ?>">(delete)</span>
                    <?php endif; ?>
                </span>
            <?php endforeach; ?>
        </div>
        <div class="title" rel="<?php echo $photo->getId(); ?>">
            <?php echo ($photo->getTitle() != '') ? $photo->getTitle() : (!$photo->isMine()) ? '' : 'Add title'; ?>
        </div>
        <div id="datePhoto">
            <?php echo format_date($photo->getCreatedAt(), 'D'); ?>
        </div>
        <?php if (sfConfig::get('app_photo_favlikeable')) : ?>
                 <?php include_component('favlike', 'favlikes', array('object' => $photo, 'model' => 'photo')) ?>
         <?php endif; ?>
        <?php if (sfConfig::get('app_photo_commentable')) : ?>
                  <?php use_javascript('/PubsPlugin/js/comment.js') ?>
                  <?php include_component('comment', 'comments', array('object' => $photo, 'model' => 'photo', 'datos' => $user)) ?>
        <?php endif; ?>
    </div>
</div>