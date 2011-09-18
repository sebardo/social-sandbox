      
        <fieldset>
             <p class="requiredText">* = <?php echo __('required', null, 'setting')?></p>
            <p class="labelPass">
                <label for="txtCurrentPassword">*&nbsp;<?php echo __('Current Password', null, 'setting')?>&nbsp;&nbsp;</label>
                <input type="password" tabindex="1" name="txtCurrentPassword" id="txtCurrentPassword">
            </p>
            <script>
                $(document).ready(function()
                {
                    $('#txtCurrentPassword').keyup(function(key){
                        $('#loading').show();
                        var pass = $('#txtCurrentPassword').val();
                        $.getJSON(base_url+"settings/checkPassword?pass="+pass,
                        function(data){
//                            alert(data);
                            $('#loading').hide();
                            if(data == true){
                               $('#sf_guard_user_password').attr('disabled', false);
                               $('#sf_guard_user_password_again').attr('disabled', false);
                            }
                            if(data == false){
                               $('#sf_guard_user_password').attr('disabled', true);
                               $('#sf_guard_user_password_again').attr('disabled', true);
                            }
                        });
                    });
                    $('#sf_guard_user_password').attr('disabled', true);
                    $('#sf_guard_user_password_again').attr('disabled', true);

                });
            </script>
           
            <p class="labelPass">
                <label for="txtNewPassword">*&nbsp;<?php echo __('New Password', null, 'setting')?>&nbsp;&nbsp;</label>
                <?php echo $form['password']->render() ?>
                </p>
                <p class="labelPass">
                    <label></label>
                    <span class="error">

                         <?php
                        if ($form['password']->getError() == "Required."){
                           echo __('All  filds are', null, 'setting') . __('required', null, 'setting');
                        }else{
                            echo $form['password']->renderError();
                        }
                           ?>
                    </span>
                 </p>
                <p style="margin-left: 210px">
                    
                   <?php echo __('The password is case-sensitive.', null, 'setting')?>
                 </p>



            <p class="labelPass">
                <label for="txtVerifyPassword">*&nbsp;<?php echo __('Verify Password', null, 'setting')?>&nbsp;&nbsp;</label>
                 <?php echo $form['password_again']->render() ?>
            </p>
            
            
            
       
        <br>
        <hr>
        <p class="labelRight">
                    <a href="<?php echo sfConfig::get('app_base_url');?>">
                    <?php echo __('Cancel', null, 'setting')?></a>&nbsp;&nbsp;&nbsp;&nbsp;   
        
        <input type="submit" value="<?php echo __('Save changes', null, 'setting')?>" tabindex="4" class="button" id="btnChangePassword" name="btnChangePassword"></p>
      <?php echo $form->renderHiddenFields(); ?>
 </fieldset>