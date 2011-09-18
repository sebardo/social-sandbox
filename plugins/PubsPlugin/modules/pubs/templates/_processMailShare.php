<div style="list-style: none;font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;font-size: 13px;margin: 14px;color:#555555;">
    <h2>Hi (<?php echo $email_dest?> )
    <?php  
        if($sf_user->isAuthenticated()){ 
        $datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $user_sender, Doctrine::HYDRATE_RECORD);
        }
    ?>
    </h2>
    <strong>
    <?php if($sf_user->isAuthenticated()){?>
        <?php echo $datos->getUsername()?> 
    <?php }?>
        (<?php echo $email_sender?>) wants to share this link with you. </strong><br><br>
        <?php echo $description?><br>
        <a href="<?php echo $url?>" title="Share link <?php echo $url?> on Social Sandbox"><?php echo $url?></a>
    <?php  
        if($sf_user->isAuthenticated()){ 
        include_component("pubs", "component_data_profile_mail", array('datos' => $datos)); 
         }
    ?>
</div>

