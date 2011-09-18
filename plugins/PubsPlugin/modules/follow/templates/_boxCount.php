<?php $news = $sf_user->getGuardUser()->getNewFollows() ?>
<a rel="follow"  class="count-button" <?php if ($news > 0)
    echo 'style="opacity:1"'; ?>  href="#">
<?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/default_avatar_s.png') ?>
    <span class="BoxCount" <?php if ($news > 0)
    echo 'style="display:block"'; ?>>
        <span ><?php echo $news ?></span>   
    </span>
</a>
<ul class="box" id="new-follows">
    <h2><a href="<?php echo sfConfig::get('app_base_url') ?>follow/newFollows" ><?php echo __('New follow request', null, 'follow')?> <?php echo image_tag('/PubsPlugin/images/loading.gif')?></a></h2>
</ul>