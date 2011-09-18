<?php $url = $sf_request->getParameter('url') ?>
<?php $host = parse_url($url, PHP_URL_HOST); ?>
<?php if ($host == 'vimeo.com') { ?>
    <?php $path = parse_url($url, PHP_URL_PATH); ?>
    <?php $clip_id = substr($path,1); ?>  
    <iframe class="iframeExpand" frameborder="0" src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $clip_id ?>&autoplay=1" ></iframe>
<?php } ?>
<?php if ($host == 'www.youtube.com') { ?>
    <?php $query = parse_url($url, PHP_URL_QUERY); ?>
    <?php $v = explode("=", $query); ?>
    <iframe class="iframeExpand" frameborder="0" src="http://www.youtube.com/v/<?php echo $v[1] ?>?version=3&autohide=1&autoplay=1" ></iframe>
<?php } ?>
<?php if ($host == 'youtu.be') { ?>
    <?php $path = parse_url($url, PHP_URL_PATH); ?>
    <iframe class="iframeExpand" frameborder="0" src="http://www.youtube.com/v<?php echo $path ?>?version=3&autohide=1&autoplay=1" ></iframe>
<?php } ?>