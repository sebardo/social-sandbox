<?php $comment = Doctrine::getTable('Comment')->find($form['reply']->getValue()) ?>
<?php use_stylesheet('/vjCommentPlugin/css/infoBulle.min.css') ?>
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_reply_author">
  <div>
    <label for="comment_reply_message"><?php echo __('Reply message', array(), 'sf_admin') ?></label>
    <div class="content">
      <a class="info">
        <?php echo commentTools::cleanQuote($comment->getBody(ESC_RAW)) ?>
        <span class="body">
          <?php echo $comment->getBody(ESC_RAW) ?>
        </span>
      </a>
    </div>
  </div>
</div>