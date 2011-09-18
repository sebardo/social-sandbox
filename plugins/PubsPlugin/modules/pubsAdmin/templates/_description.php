<?php use_stylesheet('/WallPlugin/css/infoBulle.min.css') ?>
<a class="info">
  <?php echo wallTools::cleanQuote($wall->getDescription(ESC_RAW), true) ?>
  <span class="body">
    <?php echo $wall->getDescription(ESC_RAW) ?>
  </span>
</a>