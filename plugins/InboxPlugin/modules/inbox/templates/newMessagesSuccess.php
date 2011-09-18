<?php use_helper('Date', 'Text') ?>
<script>$.getScript('<?php echo sfConfig::get('app_base_url') ?>/InboxPlugin/js/inbox.js')</script>
<h2 class="inbox"><a class="inbox-header-box" href="<?php echo sfConfig::get('app_base_url') ?>inbox" >Inbox <span id="countMessages"><?php echo count($messages) ?></span></a>
    <a  href="<?php echo sfConfig::get('app_base_url') ?>inbox/iframeFormMessage" rel="facebox" class="new-message button"><?php echo __('New Message', null, 'inbox')?></a></h2>
<ul>
    <?php
    $k = 0;
    foreach ($messages as $message):
        if ($message->getIsActive() == '0'):
            $k++;
            $user = $message->UserDest;
            ?>
            <li class="new-messages" onclick="goURL('<?php echo sfConfig::get('app_base_url'); ?>inbox?messageID=<?php echo $message->getId() ?>#<?php echo $message->getId() ?>')" title="Mensage from <?php echo $user->getName() ?>. <?php echo truncate_text($message->getDescription(), '50') ?> ">

                <?php echo image_tag($user->getImage(), 'width=40 class=thumb'); ?>
                <div class="pub-content">
                    <div class="pub-author">
                        <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $user->getUsername() ?>">
                            <?php echo $message->User ?>
                        </a>
                    </div>
                    <b><?php echo $message->getTitle() ?></b>
                    <?php echo truncate_text($message->getDescription(), '30') ?>
                    <div class="pub-info">
                        <abbr class="timestamp"><?php echo format_date($message->getCreatedAt(), "f") ?></abbr>
                    </div>
                </div>
            </li>
            <?php
        endif;
    endforeach;
    ?>
</ul>    

