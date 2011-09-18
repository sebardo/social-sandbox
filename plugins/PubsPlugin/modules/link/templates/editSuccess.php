<?php include_javascripts(); ?>
<?php include_stylesheets(); ?>
<script>
    jQuery(document).ready(function($) {
        $('#facebox',window.parent.document).animate({height:'150px'}, 500);
        $('.pop_up',window.parent.document).animate({height:'150px'}, 500);
        $('.content',window.parent.document).animate({height:'150px'}, 500);
        $('.iframeNewLinkSuccess',window.parent.document).animate({height:'150px'}, 500);
    });
</script>
<div class="content-link">
    <?php $obj = $form->getObject(); ?>
    <?php include_component('link', 'link', array('id' => $obj->getId(), 'edit' => true)) ?>
    <?php include_partial('form', array('form' => $form, 'duid' => $duid)) ?>
</div>