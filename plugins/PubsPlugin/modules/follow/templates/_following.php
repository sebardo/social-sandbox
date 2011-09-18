<?php $follow = Doctrine::getTable('Follow')->getFollowing($sf_user->getGuardUser()->getId(), $datos->getId()) ?>
<?php
if ($follow) {
    if ($follow->getIsActive() == "1") {
        $following = 1;
    } elseif ($follow->getIsActive() == "2") {
        $following = 2;
    }
} else {
    $following = 3;
}
?>
<div id="enable" style="float:right;display:<?php
if ($following == "1" || $following == "3") {
    echo "inline-block";
} else {
    echo "none";
}
?>">
    <a user-id="<?php echo $sf_user->getGuardUser()->getId()?>" 
       follow-id="<?php echo $datos->getId()?>" id="profile-follow-button" class="button <?php
     if ($following == "1") {
         echo "profile-unfollow-link";
     } else {
         echo "profile-follow-button";
     }
?>" href="#">
        <span class="you-follow" style="display: <?php
       if ($following == "1") {
           echo "inline-block";
       } else {
           echo"none";
       }
?>"></span>
        <span class="plus" style="display:
        <?php
        if ($following == "1" || $following == "2") {
            echo "none";
        } else {
            echo "inline-block";
        }
        ?>
              "></span>
        <em class="wrapper" style="display: <?php
        if ($following == "1") {
            echo "";
        } else {
            echo"none";
        }
        ?>">
            <b><?php echo __('Following', null, 'follow') ?></b>
            <b class="unfollow"><?php echo __('Stop following', null, 'follow') ?></b>
        </em>

        <strong class="no-follow" style="display:
        <?php
        if ($following == "1") {
            echo "none";
        } elseif ($following == "3") {
            echo "inline-block";
        }
        ?>
                "><?php echo __('Follow', null, 'follow') ?></strong>
    </a>
</div>
<div  id="cancel" style="float:right;display:<?php
        if ($following == "2") {
            echo "inline-block";
        } else {
            echo "none";
        }
        ?>">
    <b class="request-sent"><?php echo __('Your request has been sent.', null, 'follow') ?> </b>
    <a user-id="<?php echo $sf_user->getGuardUser()->getId()?>" 
       follow-id="<?php echo $datos->getId()?>"  id="request-follow-button" class="button request-unfollow-link" style="float:right">
        <span class="you-follow"></span>
        <?php echo __('Cancel request', null, 'follow') ?> 
    </a>
</div>