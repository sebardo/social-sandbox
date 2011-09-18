<?php use_helper('I18N') ?>
<script>
    var base_url = '<?php echo sfConfig::get('app_base_url'); ?>';
    $(document).ready(function(){  
        var email = new LiveValidation('recuperar_email_address',{validMessage: "ok"});
        email.add( Validate.Presence );
        email.add( Validate.Email );
        $('#recuperar_email_address').keydown(function() {
            var q =$('#recuperar_email_address').val();
            $.get(base_url+"sfGuardRegister/getAllUsersEmail?q="+q, function(info){             
                email.add( Validate.Inclusion, { within: info } );
            });
        });
    });
</script>


<div class="register_ok" style="float: right">
    <h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>

    <p>
        <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?><br>
        <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
    </p>

    <form class="forgot_password" action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
        <table>
            <tbody>
                <tr>
                    <th width="130"><label for="forgot_password_email_address"><?php echo __('Email', null, 'sf_guard') ?></label></th>
                    <td >
                        <?php echo $form['email_address']->render() ?>
                        <?php echo $form->renderHiddenFields(); ?>
                    </td>
                    <td align="right">
                        <input type="submit" class="submit" name="change" value="<?php echo __('Request', null, 'sf_guard') ?>" />
                    </td>
                </tr>

            </tbody>

        </table>
    </form>
</div>
