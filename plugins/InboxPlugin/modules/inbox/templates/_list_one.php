<?php use_helper('Date') ?>
<?php if ($first_message->getUserId() != $sf_user->getGuardUser()->getId()) { ?>
    <div id="<?php echo $first_message->getId() ?>" class="stream">
        <div class="stream-items">
            <div class="stream-item  focused-stream-item">
                <div class="message-thread-preview stream-item-content">
                    <div class="more">»</div>
                    <div class="message-inner">
                        <?php echo image_tag($first_message->User->getImage(), 'width=32 class=thumb'); ?>
                        <span class="user-name"><strong><?php echo $user->getUsername() ?></strong> <b class="full-name"><?php echo $user->getName() ?></b></span>
                        <div class="message-content">
                            <span class="created-at"><span class="_timestamp"><?php echo format_date($first_message->getCreatedAt(), "f") ?></span></span>
                            <div class="message-count">1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($first_message->getUserId() == $sf_user->getGuardUser()->getId()) { ?>
    <div id="<?php echo $first_message->getId() ?>" class="stream">
        <div class="stream-items">
            <div class="stream-item  focused-stream-item">
                <div class="message-thread-preview stream-item-content">
                    <div class="more">»</div>
                    <div class="message-inner">
                        <?php echo image_tag($first_message->UserDest->getImage(), 'width=32 class=thumb'); ?>
                        <span class="user-name"><strong><?php echo $first_message->UserDest->getUsername() ?></strong> <b class="full-name"><?php echo $first_message->UserDest->getName() ?></b></span>
                        <div class="message-content">
                            <span class="created-at"><span class="_timestamp"><?php echo format_date($first_message->getCreatedAt(), "f") ?></span></span>
                            <div class="message-count">1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>




