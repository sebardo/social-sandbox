<?php use_helper('Date');?>
<div onclick="goURL('<?php echo sfConfig::get('app_base_url') . 'pubs?pid=' ?>')" href="" class="new-advice">
    <?php echo image_tag($fav->User->getImage(), 'width=50') ?>
    <div class="pub-content">
        <div class="pub-author">
            <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $fav->User->getUsername() ?>">
                <?php echo $fav->User->getUsername() ?>
            </a>
        </div>
        likes your  <?php if($fav->getRecordModel() == 'text') echo 'publication'; else echo $fav->getRecordModel() ?>.
        <div class="pub-info">
            <i class="favlike"></i>
            <?php echo format_date($fav->getCreatedAt(), "f") ?> 
        </div>
    </div>
</div>
