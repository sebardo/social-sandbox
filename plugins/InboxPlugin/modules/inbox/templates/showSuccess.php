<link href="<?php echo sfConfig::get('app_base_url');?>InboxPlugin/css/inbox.css" media="screen" type="text/css" rel="stylesheet">
<script src="<?php echo sfConfig::get('app_base_url');?>sfDoctrineGuardPlugin/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="<?php echo sfConfig::get('app_base_url');?>WallPlugin/js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
 $(document).ready(function(){

  $('#facebox',window.parent.document).hide().animate({height:'20px'}, 500);
  $('.pop_up',window.parent.document).hide().animate({height:'20px'}, 500);
  $('.content',window.parent.document).hide().animate({height:'20px'}, 500);
  $('.new_message_form',window.parent.document).hide().animate({height:'20px'}, 500);
  
    $('#facebox',window.parent.document).delay(1500).fadeOut(function() {
      $('#facebox .loading',window.parent.document).remove()
       $("#facebox_overlay",window.parent.document).remove()
      $(document,window.parent.document).trigger('afterClose.facebox')
    })

});
</script>
<style>
body{
    font: 13.34px helvetica,arial,freesans,clean,sans-serif;

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
<?php echo __('Your message has been sent', null, 'inbox')?> <i></i> 