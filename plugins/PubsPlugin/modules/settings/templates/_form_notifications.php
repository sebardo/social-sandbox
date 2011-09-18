<div class="content-section">
    <script>
        $(document).ready(function()
        {
            $('.check').click(function(key){
                $('#loading').show();       
                var user_id = $(this).attr('user-id');         
                var setting_id = $(this).attr('setting-id');
                var div = $(this).attr('data-div');
                $.get(base_url+"settings/SettingUser?user_id="+user_id+"&setting_id="+setting_id,
                function(data){
                });
            });
        });
    </script>
    <p class="lead"><?php echo __('Choose when and how often you send messages to', null, 'setting')?> <?php echo $sf_user->getGuardUser()->getEmailAddress() ?> (<a href="settings?config=name"><?php echo __('change', null, 'setting')?></a>).</p>
    <fieldset>

        <div class="clearfix">
            <label><?php echo __('Send me an email when', null, 'setting')?></label>
            <div class="input">
                <ul class="options">


                    <?php $settings = Doctrine::getTable('Setting')->findBy('is_active', true); ?>
                    <?php foreach ($settings as $setting): ?>


                        <li>
                            <?php $setting_user = Doctrine::getTable('Setting_has_User')->SettingUser($sf_user->getGuardUser()->getId(), $setting->getId()); ?>


                            <input user-id="<?php echo $sf_user->getGuardUser()->getId() ?>" setting-id="<?php echo $setting->getId() ?>" class="check" type="checkbox" name="check_name_<?php echo $setting->getId() ?>" id="check_<?php echo $setting->getId() ?>-<?php echo $setting->getId() ?>" 
                                   <?php if ($setting_user) { ?>
                                       <?php if ($setting_user->getIsActive() == true) { ?>
                                           checked="checked"
                                       <?php } ?>
                                   <?php } else { ?>

                                   <?php } ?>  
                                   >
                            <label for="user_send_new_direct_text_email">
                                <?php echo __($setting->getDescription(), null, 'setting') ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </fieldset>


</div>