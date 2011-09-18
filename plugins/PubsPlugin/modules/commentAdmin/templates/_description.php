<?php use_helper('Text') ?>
<?php use_stylesheet('/PubsPlugin/css/infoBulle.min.css') ?>
<span class="body">
    <?php echo $comment->getDescription(ESC_RAW) ?>
</span>
