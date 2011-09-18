<script type="text/javascript">
    $(document).ready(function(){

        $('#facebox',window.parent.document).hide().animate({height:'40px'}, 500);
        $('.pop_up',window.parent.document).hide().animate({height:'40px'}, 500);
        $('.content',window.parent.document).hide().animate({height:'40px'}, 500);
        $('.iframeNewTextSuccess',window.parent.document).hide().animate({height:'40px'}, 500);
        $('#loading',window.parent.document).hide();
        parent.showLast(<?php echo $pub->getId() ?>)
        $('#facebox',window.parent.document).delay(1500).fadeOut(function() {
            $('#facebox .loading',window.parent.document).remove()
            $("#facebox_overlay",window.parent.document).remove()
            $(document,window.parent.document).trigger('afterClose.facebox')
        })
    });
</script>
<style type="text/css">
#ContResult{
        margin: 10px;
}
body i {
        background-image: url("/PubsPlugin/images/sprite-icons.png");
        background-position: -141px -304px;
        display: inline-block;
        height: 13px;
        margin-left: 10px;
        width: 18px;
    }
</style>
Published Successfully<i></i>