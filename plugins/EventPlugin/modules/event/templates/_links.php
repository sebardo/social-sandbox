<style type="text/css">
    #globalheader{
        margin-bottom: 0;
    }
    #contEnlaces {
        height: 50px;
        overflow: hidden;
        position: absolute;
        top: -20px;
        width: 100%;
    }
</style>
<?php
if ($sf_request->hasParameter('user')) {
    $requestedUser = $sf_request->getParameter('user');
    if (is_numeric($requestedUser)) {
        $userId = $requestedUser;
    } else {
        $userId = Doctrine::getTable('sfGuardUser')->findOneBy('username', $requestedUser, Doctrine::HYDRATE_RECORD)->getId();
    }
} else {
    $userId = false;
}
?>

<div id="contEnlaces">
    <div id="enlaces">
        <?php if ($sf_user->isAuthenticated()): ?>

            <?php if (sfContext::getInstance()->getActionName() != 'new'): ?>
                <a class="button" href="<?php echo url_for('event/new') ?>"><?php echo __('Create an event', null, 'event') ?></a>
            <?php endif; ?>

            <?php if ($userId != $sf_user->getGuardUser()->getId()): ?>
                <a class="button" href="<?php echo url_for('event/list?user=' . $sf_user->getGuardUser()->getUsername()) ?>"><?php echo __('My events', null, 'event') ?></a>
            <?php endif; ?>

        <?php endif; ?>

        <?php if (isset($event)): ?>

            <?php if ($event->isMine()): ?>
                <?php $confirm = __('¿Sure?', null, 'event')?>
                <a class="button" href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>"><?php echo __('Edit', null, 'event') ?></a>
                <?php echo link_to(__('Delete', null, 'event'), 'event/delete?id=' . $event->getId(), array('method' => 'delete', 'confirm' => $confirm, 'class' => 'button')) ?>
            <?php endif; ?>

            <?php if (!$event->isMine()): ?>
                <a class="button" href="<?php echo url_for('event/list?user=' . $event->getUser()->getUsername()) ?>"><?php echo __('Events by ', null, 'event') . $event->User->getName(); ?></a>
            <?php endif; ?>

        <?php endif; ?>

        <?php if (sfContext::getInstance()->getActionName() != 'index'): ?>
            <a class="button" href="<?php echo url_for('event/index') ?>"><?php echo __('All events', null, 'event') ?></a>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    var isMoving=false;
    $('#enlaces').hover(
    function(){
        if(!isMoving){
            isMoving=true;
            $(this).animate({top:0}, 'slow', function() {isMoving=false;});
        }
        
    },
    function(){
        if(!isMoving){
            isMoving=true;
            $(this).animate({top:-40}, 'slow', function() {isMoving=false;});
        }
    });
    $('#enlaces').click(function(){$(this).animate({top:-40}, 'slow', function() {isMoving=false;});});
</script>