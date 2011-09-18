
<ul class="stream-tabs">
    <?php if (!$sf_user->isAuthenticated()) { ?>
        <li class="stream-tab  active">
            <a  rel="home/information" class="tab-text" href=""><?php echo __('Information', null, 'setting') ?><i style="opacity:1!important;"></i></a>
        </li>
    <?php } else { ?>
        <li  class="stream-tab active">
            <a  rel="home/listAjaxHome" class="tab-text" href="<?php echo url_for('@home') ?>"><?php echo __('Home', null, 'pubs') ?><i></i></a>
        </li>
        <li class="stream-tab">
            <a  rel="pubs/listAjax" class="tab-text" href="#"><?php echo __('My', null, 'pubs') ?> <?php echo __('Pubs', null, 'pubs') ?><i></i></a>
        </li>

        <?php include_partial('location/location')?>
    <?php } ?>

    

</ul>

