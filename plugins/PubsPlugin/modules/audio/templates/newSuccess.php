<?php include_stylesheets(); ?>
<?php include_javascripts(); ?>
<?php if ($sf_request->getParameter('delete') == '1') { ?>
    <script>
        jQuery(document).ready(function($) {
            $('#facebox',window.parent.document).animate({height:'117px'}, 500);
            $('.pop_up',window.parent.document).animate({height:'117px'}, 500);
            $('.content',window.parent.document).animate({height:'117px'}, 500);
            $('.iframeNewAudioSuccess',window.parent.document).animate({height:'117px'}, 500);
        });
    </script>
<?php } ?>
<?php include_partial('form', array('form' => $form, 'duid' => $sf_request->getParameter('duid'), 'audio' => $sf_request->getParameter('audio'))) ?>
