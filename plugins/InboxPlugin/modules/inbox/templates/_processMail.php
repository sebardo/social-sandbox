<div style="list-style: none;font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;font-size: 13px;margin: 14px;color:#555555;">
    <h2>Hi <?php echo $data_user->getUsername() ?></h2>
    <strong><?php echo $data_sender->getUsername() ?> ) has sent a private message to your Inbox. </strong><br>
    <?php include_component("pubs", "component_data_profile_mail", array('datos' => $data_sender)); ?>
</div>
