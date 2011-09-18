<ul class="stream-tabs">
    <li class="stream-tab">
        <a rel="home/listAjaxHome" href="<?php echo url_for('@home') ?>" class="tab-text"><?php echo __('Home', null, 'follow') ?><i class="flecha"></i></a>
    </li>
    
    <li class="stream-tab ">
        <a rel="pubs/listAjax" href="<?php echo url_for('@pubs') ?>" class="tab-text"><?php echo __('Pubs', null, 'follow') ?><i class="flecha"></i></a>
    </li>

    <li  class="stream-tab <?php if ($action == 'favlikes')
    echo 'active' ?>">
        <a rel="favlike/list" href="<?php if (!$sf_request->getParameter('user'))
    echo url_for('@favlike'); else
    echo url_for('favlike', array('user' => $sf_request->getParameter('user'))) ?>" class="tab-text"><?php echo __('Favlikes', null, 'follow') ?><i class="flecha"></i></a>
    </li>

    <li class="stream-tab <?php if ($action == 'index')
    echo 'active' ?>">
        <a  rel="follow/list" class="tab-text"><?php echo __('Followings', null, 'follow') ?><i class="flecha"></i></a>
    </li>

    <li class="stream-tab <?php if ($action == 'followers')
    echo 'active' ?>">
        <a rel="follow/listFollowers" class="tab-text"><?php echo __('Followers', null, 'follow') ?><i class="flecha"></i></a>
    </li>

<?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
        <li class="stream-tab<?php if ($action == 'newFollows')
        echo 'active' ?>">
            <a rel="follow/newFollowing" href="<?php if (!$sf_request->getParameter('user'))
        echo url_for('@newFollows'); else
        echo url_for('newFollows', array('user' => $sf_request->getParameter('user'))) ?>" class="tab-text"><?php echo __('New Follows', null, 'follow') ?><i class="flecha"></i></a>
        </li>
<?php } ?>
</ul>


