<h2><?php echo __('New Message', null, 'inbox') ?></h2>
<iframe scrolling="NO" frameborder="0"
        style="height: 180px;
        margin-top: 10px;
        margin-bottom: 10px;
        position: relative;
        width: 350px;"  
        src="<?php echo sfConfig::get('app_base_url'); ?>inbox/new?user=<?php echo $sf_request->getParameter('user')?>"  class="new_message_form"></iframe>

