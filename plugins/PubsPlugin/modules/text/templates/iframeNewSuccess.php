<h2><?php echo __('New Text', null, 'pubs')?> <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span></h2>
<iframe frameborder="0" src="<?php echo sfConfig::get('app_base_url')?>text/new?duid=<?php echo $duid?>" class="iframeNewTextSuccess" ></iframe>
 