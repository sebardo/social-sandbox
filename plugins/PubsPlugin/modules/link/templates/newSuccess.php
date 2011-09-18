<?php include_stylesheets(); ?>
<?php include_javascripts(); ?>
<?php if ($sf_request->getParameter('delete') == '1') { ?>
    <script>
        jQuery(document).ready(function($) {
            $('#facebox',window.parent.document).animate({height:'60px'}, 500);
            $('.pop_up',window.parent.document).animate({height:'60px'}, 500);
            $('.content',window.parent.document).animate({height:'60px'}, 500);
            $('.iframeNewLinkSuccess',window.parent.document).animate({height:'60px'}, 500);
        });
    </script>
<?php } ?>
    


<?php include_partial('form', array('form' => $form, 'duid' => $sf_request->getParameter('duid'))) ?>


