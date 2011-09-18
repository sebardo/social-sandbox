<h2><?php echo __('New Link', null, 'pubs')?> <span id="loading" style="display: none"><?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif') ?></span></h2>
<iframe frameborder="0" src="<?php echo sfConfig::get('app_base_url')?>link/new?duid=<?php echo $duid?>" class="iframeNewLinkSuccess" ></iframe>
 