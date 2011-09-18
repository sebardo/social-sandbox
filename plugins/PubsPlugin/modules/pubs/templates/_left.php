<ul class="stream-tabs">
    <li class="stream-tab">
        <a  rel="home/listAjaxHome" class="tab-text" href="<?php echo url_for('@home') ?>"><?php echo __('Home', null, 'pubs') ?><i></i></a>
    </li>
    <li class="stream-tab active">
        <a rel="pubs/listAjax<?php if ($sf_request->getParameter('user'))
    echo '?user=' . $sf_request->getParameter('user') ?>" class="tab-text" href="<?php echo url_for('@pubs') ?><?php if ($sf_request->getParameter('user'))
                echo '?user=' . $sf_request->getParameter('user') ?>">
            <?php
            if ($sf_user->getguardUser()->getId() == $datos->getId())
                echo __('My', null, 'pubs');
            else
                echo $sf_request->getParameter('user')
                ?>
    <?php echo __('Pubs', null, 'pubs') ?><i></i></a>
    </li>

    <!--    FALLOWS-->
            <?php if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) { ?>
        <li class="stream-tab">
            <a rel="follow/list<?php if ($sf_request->getParameter('user'))
                echo '?user=' . $sf_request->getParameter('user') ?>" class="tab-text" href="<?php echo url_for('@follow') ?>">
    <?php
    if ($sf_user->getguardUser()->getId() == $datos->getId())
        echo __('My', null, 'pubs');
    else
        echo $sf_request->getParameter('user')
        ?> <?php echo __('Followings', null, 'pubs') ?><i></i></a>
        </li>
        <li class="stream-tab">
            <a rel="follow/listFollowers<?php if ($sf_request->getParameter('user'))
                echo '?user=' . $sf_request->getParameter('user') ?>" class="tab-text" >
    <?php
    if ($sf_user->getguardUser()->getId() == $datos->getId())
        echo __('My', null, 'pubs');
    else
        echo $sf_request->getParameter('user')
        ?> <?php echo __('Followers', null, 'pubs') ?><i></i></a>
        </li>
    <?php } ?>
    <!--    FAVLIKE-->
    <?php if (in_array('favlike', sfConfig::get('sf_enabled_modules', array()))) { ?>
        <li class="stream-tab">
            <a rel="favlike/list<?php if ($sf_request->getParameter('user'))
        echo '?user=' . $sf_request->getParameter('user') ?>" class="tab-text" href="<?php echo url_for('@favlike') ?>">
    <?php
    if ($sf_user->getguardUser()->getId() == $datos->getId())
        echo __('My', null, 'pubs');
    else
        echo $sf_request->getParameter('user')
        ?> <?php echo __('Favlikes', null, 'pubs') ?><i></i></a>
        </li>
<?php } ?>
<?php if ($sf_user->getguardUser()->getId() == $datos->getId()) { ?>
    <?php include_partial('location/location') ?>
<?php } ?>
</ul>

