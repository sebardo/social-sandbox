<?php use_helper('Date');?>
<div onclick="goURL('<?php echo sfConfig::get('app_base_url') . 'pubs?pid=' ?>')" href="" class="new-advice">
    <?php echo image_tag($comment->User->getImage(), 'width=50') ?>
    <div class="pub-content">
        <div class="pub-author">
            <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $comment->User->getUsername() ?>">
                <?php echo $comment->User->getUsername() ?>
            </a>
        </div>
        comment your  <?php if($comment->getRecordModel() == 'text') echo 'publication'; else echo $comment->getRecordModel() ?>.
        <div class="pub-info">
            <i class="comment-count"></i>
            <?php echo format_date($comment->getCreatedAt(), "f") ?> 
        </div>
    </div>
</div>
