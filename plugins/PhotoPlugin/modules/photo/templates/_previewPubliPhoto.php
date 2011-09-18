<style type="text/css">
    .publish, .close-photo{margin:0px 5px;float: right;}
    .pub_new_photo_attach{
        overflow: hidden;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
        background-color: #FFFFFF;
        padding:10px;
    }
</style>
<div class="pub_new_photo_attach">
    <div class="pub_new_photo" > <h3><?php echo __('Photo uploaded correctly', null, 'photo')?></h3> </div>
    <div id="contSharePhoto"><?php echo image_tag($photo->getThumb());?></div>
    <a class="button publish" href="#"><i><?php echo __('Publish', null, 'photo')?></i></a>
    <a class=" button close-photo" href="#"><?php echo __('Close', null, 'photo')?></a>
</div>

