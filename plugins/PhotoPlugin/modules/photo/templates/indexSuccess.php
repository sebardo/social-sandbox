
<script type="text/javascript">
    $(document).ready(function(){
        var urls={};
        var selectors={};
        var params={};
        var traduction={};

        urls.base=            '<?php echo sfConfig::get('app_base_url'); ?>';
        urls.list=            '<?php echo url_for('photo/list'); ?>';
        urls.ordPhoto=        '<?php echo url_for('photo/ord'); ?>';
        urls.ordAlbum=        '<?php echo url_for('album/ord'); ?>';
        urls.deleteAlbum=     '<?php echo url_for('album/delete'); ?>';
        urls.deletePhoto=     '<?php echo url_for('photo/delete'); ?>';
        urls.movePhoto=       '<?php echo url_for('photo/move'); ?>';
        urls.editTitle=       '<?php echo url_for('album/editTitle'); ?>';
        urls.showAlbum=       '<?php echo url_for('album/show'); ?>';
        urls.showPhoto=       '<?php echo url_for('photo/show'); ?>';
        urls.editPhoto=       '<?php echo url_for('photo/edit'); ?>';
        urls.setProfilePhoto= '<?php echo url_for('photo/setProfilePhoto'); ?>';
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
        traduction.frase10 =   "<?php echo __("Don't load album because the album selected is: ", null, 'photo')?>"
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

        
        

        selectors.albums=        '#albums';
        selectors.photos=        '#photos';
        selectors.album=         '.album';
        selectors.photo=         '.photo';
        selectors.amountPhotos=  '.amountPhotos';
        selectors.amountAlbums=  '.amountAlbums';
        selectors.contFormPhoto= '#contFormPhoto';
        selectors.formPhoto=     '#formPhoto';
        selectors.addPhoto=      '#addPhoto';
        selectors.addPhoto2=     '#addPhoto2';
        selectors.cover=         '.cover';
        selectors.title=         '.title';
        selectors.sortablePhoto= "#sortablePhoto";
        selectors.sortableAlbum= "#sortableAlbum";

        params.urls=             urls;
        params.traduction=       traduction;
        params.selectors=        selectors;
        params.profileAlbumName= '<?php echo Album_photo::getProfileAlbumName(); ?>';
        params.userId=           '<?php echo $sf_user->getGuardUser()->getId(); ?>';
        params.albumUserId=      '<?php echo $user->getId(); ?>';
        //params.debugMode=true;

        var galery=new Galery(params);
        galery.init();
    });
</script>

<div id="galeryContainer">

        <ul>
            <li id="albums">
                <?php include_component("album", "list", array('user' => $user)); ?>
            </li>

            <li id="photos">
                <?php include_component("photo", "list", array('user' => $user)); ?>
            </li>
        </ul>


</div>
