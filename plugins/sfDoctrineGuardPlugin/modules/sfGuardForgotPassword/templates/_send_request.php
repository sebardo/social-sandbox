<?php use_helper('I18N') ?>   
<div style="list-style: none;font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;font-size: 13px;margin: 14px;color:#555555;">
<h2><?php echo __('Hi %name%', array('%name%' => $user->getUsername()), 'sf_guard') ?>,<br/><br/></h2>
<?php echo __('This e-mail is being sent because you requested information on how to reset your password.', null, 'sf_guard') ?><br/><br/>
<?php echo __('You can change your password by clicking the below link which is only valid for 24 hours:', null, 'sf_guard') ?><br/><br/>
Click the next link to change password<br/><br/>
<a target="_blank" href="<?php echo sfConfig::get('app_base_url')?>/forgot_password/<?php echo $forgot_password->unique_key ?>">http://sandbox.nordestelabs.com/guard/forgot_password/<?php echo $forgot_password->unique_key ?></a>
<?php //echo link_to(__('Click to change password', null, 'sf_guard'), '@sf_guard_forgot_password_change?unique_key='.$forgot_password->unique_key, 'absolute=true') ?>
</div>
