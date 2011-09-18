<?php //echo var_dump($users); ?>
<div class="result"><?php echo count($users) ?> <?php echo __('Results', null, 'search') ?></div>
<ul class="users">
    <?php foreach ($users as $row) { ?>

    <li onclick="goURL('/pubs?user=<?php echo $row->getusername()?>')">
            <span><?php echo str_replace(" ", "&nbsp;", $row->getusername()); ?></span>
            <div>
                <?php echo image_tag($row->getImage('70', '70', 'thumb'), 'width=70') ?>
            </div>

        </li>
    <?php } ?>
</ul>