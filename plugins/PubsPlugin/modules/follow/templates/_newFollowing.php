<?php use_helper('Date', 'Text') ?>
<?php use_javascript(sfConfig::get('app_base_url').'PubsPlugin/js/newfollow.js') ?>
<style>
    body{
        font: 13.34px helvetica,arial,freesans,clean,sans-serif;
        margin: 0;
        margin-top: 10px;
    }
    .pop i {
        background-image: url("/PubsPlugin/images/sprite-icons.png");
        background-position: -141px -304px;
        display: inline-block;
        height: 13px;
        margin-left: 10px;
        width: 18px;
    }
</style>
<a class="pop" id="accepted" href="#" rel="facebox" style="display: none; ">
    <div style="border-radius: 3px 3px 3px 3px; background-color: #FFFFFF;margin-top: 10px;margin-bottom: 15px;margin-right: 10px"> <?php echo __('The request have been acepted', null, 'follow')?><i></i></div>
</a>
<a class="pop" id="rejected" href="#" rel="facebox" style="display: none; ">
    <div style="border-radius: 3px 3px 3px 3px; background-color: #FFFFFF;margin-top: 10px;margin-bottom: 15px;margin-right: 10px"> <?php echo __('The request have been rejected', null, 'follow')?><i></i></div>
</a>
<div class="Box" id="FollowBox" >
    <div>
        <h2>
            <?php echo __('New following request', null, 'follow') ?>
            <span id="countFollows">
                <?php echo count($follows) ?>
            </span>
        </h2>
    </div>
    <ul id="followBoxItems">
        <?php
        $k = 0;
        foreach ($follows as $follow):
            $k++;
            $user = Doctrine::getTable('sfGuardUser')->find($follow->getUserId());
            ?>
            <li>
                <div id="new-following-<?php echo $follow->getId() ?>" class="new-following follower">
                    <?php echo image_tag($follow->User->getImage(), 'width=50 class=thumb'); ?>
                    <div class="content UIImageBlock_Content UIImageBlock_SMALL_Content fsm fwn fcg">
                        <div class="author"><b><?php echo $user->getUsername() ?></b> <?php echo __('have been sent a following request', null, 'follow')?></div>
                        <div class="preview">
                            <span class="subject">
                                <span id="follow-link-accept" rel="<?php echo $follow->getId() ?>" class="button follow-link">
                                    <span style="display: inline-block" class="you-follow"></span>
                                    <b><?php echo __('Accept', null, 'follow')?></b>
                                </span>  
                                <span class="button unfollow-link" rel="<?php echo $follow->getId() ?>">
                                    <span style="display: inline-block" class="you-follow"></span>
                                    <b><?php echo __('No accept', null, 'follow')?></b>
                                </span>  
                            </span> 
                        </div>
                        <div class="time">
                            <abbr class="timestamp" data-date="" title=""><?php echo format_date($follow->getCreatedAt(), "f") ?></abbr>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</div>

