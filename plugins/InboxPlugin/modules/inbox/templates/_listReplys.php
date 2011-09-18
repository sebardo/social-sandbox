<?php use_helper('Date') ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=delete]').unbind('keydown.facebox');
        $('a[rel*=delete]').facebox();
    });
</script>

<?php
$k = 0;
foreach ($inbox as $message):
    $k++;
    ?>
    <?php $user = Doctrine::getTable('sfGuardUser')->find($message->getUserId()); ?>
    <div id="reply-<?php echo $message->getId() ?>" class="messages-pane">
        <a name="<?php echo $message->getId() ?>"></a>
        <div class="message">
            <div class="message-inner">
                <?php echo image_tag($message->User->getImage(), 'width=48 class=thumb'); ?>
                <span class="user-name">
                    <a title="<?php echo $user->getName() ?>" href="#" class="user-profile-link"><?php echo $user->getUsername() ?></a>
                </span>
                <div class="message-content">
                    <div class="linked-text"><?php echo $message->getDescription() ?>
                    </div>

                    <div class="pub-actions">
                        <span class="created-at">
                            <span class="_timestamp"><?php echo $message->getCreatedAt() ?></span>   
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>


