<?php $display = isset($display) ? $display : 'mosaico'; ?>
<?php if ($display=='list'):?>
<style type="text/css">
    .event{
        height: 22px;
        overflow: hidden;
        float:none;
    }
</style>
<?php endif;?>

<div class="listContainer">
<?php foreach ($events as $event): ?>

    <div class="event">
        <?php include_partial('event/event', array('event' => $event)); ?>
    </div>

<?php endforeach; ?>
</div>
<?php if ($display=='list'):?>
<script type="text/javascript">
    $('.listContainer .event').click(
        function(){
            if($(this).hasClass('desplegado')){
            $('.listContainer .event').animate({height:22},300);
                $(this).removeClass('desplegado');
            }else{
            $('.listContainer .event').removeClass('desplegado').animate({height:22},300);
                $(this).addClass('desplegado');
                $(this).animate({height:100},300);
            }
            
        });
</script>
<?php endif;?>