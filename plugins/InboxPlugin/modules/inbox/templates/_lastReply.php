<?php use_helper('Date') ?>
<script type="text/javascript">
    $(document).ready(function($) {
        $('a[rel*=delete]').unbind('click.facebox');
        $('a[rel*=delete]').facebox();
    });
</script>
<?php $user = Doctrine::getTable('sfGuardUser')->find($message->getUserId()); ?>
<div id="reply-<?php echo $message->getId() ?>" class="messages-pane">
    <div class="message" >
        <div class="message-inner">
            <?php echo image_tag($message->User->getImage(), 'width=32 class=thumb'); ?>
            <span class="user-name">
                <a class="user-profile-link" href="#"><?php echo $user->getUsername() ?> </a>
            </span>
            <div class="message-content">
                <div class="linked-text"><?php echo $message->getDescription() ?> </div>
                <div class="message-footer">
                    <span class="created-at">
                        <span class="_timestamp"><?php echo format_date($message->getCreatedAt(), "f") ?></span>   
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>