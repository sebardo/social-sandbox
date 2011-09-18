<h2><?php echo __('New Photo', null, 'photo')?> <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span></h2>
<script type="text/javascript">
    $(document).ready(function(){
        var $photoPubBox=$('#photo-pub-box');
        var $msjBoxPhotos=$('.msj-box .photos');
        var $contResult=$('#ContResult');
        $msjBoxPhotos.click(function(e){
            e.preventDefault();
            $photoPubBox.slideDown('fast');
        });
    });
</script>
<div id="photo-pub-box">
    <iframe frameborder="0" src="<?php echo sfConfig::get('app_base_url'); ?>photo/share?duid=<?php echo $duid ?>"  class="iframeNewPhotoSuccess"></iframe>
</div>
<div id="ContResult" style="display:none;"></div>
