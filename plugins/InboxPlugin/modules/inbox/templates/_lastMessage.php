<?php use_helper('Date') ?>
<div class="stream">
    <div class="stream-items">
        <div data-item-type="message_thread" data-item-id="sastus" class="stream-item  focused-stream-item">
            <div data-screen-name="sastus" class="message-thread-preview stream-item-content">
                <div class="more">»</div>
                <div class="message-inner">
                    <?php echo image_tag($message->User->getImage(), 'width=32 class=thumb'); ?>
                    <span class="user-name"><strong>sastus</strong> <b class="full-name">sebastian sasturain</b></span>
                    <div class="message-content">
                        <span class="created-at"><span data-include-sec="true" data-long-form="true" data-time="1304070478000" class="_timestamp"><?php echo format_date($message->getCreatedAt(), "f") ?></span></span>
                        <div class="message-count">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>