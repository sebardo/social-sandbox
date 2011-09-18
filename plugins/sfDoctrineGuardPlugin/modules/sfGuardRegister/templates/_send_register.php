<?php use_helper('I18N') ?>   
<div style="list-style: none;font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;font-size: 13px;margin: 14px;color:#555555;">
<h2><?php echo __('Hi %name%', array('%name%' => $user->getUsername()), 'sf_guard') ?>,<br/><br/></h2>
<?php echo __('Your acount has created succesfully.', null, 'sf_guard') ?><br/><br/>
<?php echo __('Please click the following link to activate your account', null, 'sf_guard') ?><br/><br/>
<?php echo link_to(__(sfConfig::get('app_base_url').'guard/register?salt='.$user->getSalt(), null, 'sf_guard'), sfConfig::get('app_base_url').'guard/register?salt='.$user->getSalt() ) ?>
