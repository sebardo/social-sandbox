<?php use_helper('I18N') ?>

<script>
    var base_url = '<?php echo sfConfig::get('app_base_url'); ?>';
    $(document).ready(function(){  
        var email = new LiveValidation('sf_guard_user_email_address',{validMessage: "ok"});
        email.add( Validate.Presence );
        email.add( Validate.Email );
        $('#sf_guard_user_email_address').keydown(function() {
            var q =$('#sf_guard_user_email_address').val();
            $.get(base_url+"sfGuardRegister/getAllUsersEmail?q="+q, function(info){             
                email.add( Validate.Exclusion, { within: info } );
            });
        });
        
        var username = new LiveValidation('sf_guard_user_username',{validMessage: "ok"});
        username.add( Validate.Presence , { failureMessage: "<?php echo __("Type your username", null, 'audio')?>" });
        username.add( Validate.Length, { minimum: 4, maximum: 20 } );
        $('#sf_guard_user_username').keydown(function() {
            var q =$('#sf_guard_user_username').val();
            $.get(base_url+"sfGuardRegister/getAllUserName?q="+q, function(info){ 
                username.add( Validate.Exclusion, { within: info } );
            });
        });
        
        var password = new LiveValidation('sf_guard_user_password',{validMessage: "ok"});
        password.add( Validate.Presence , { failureMessage: "<?php echo __("Type your password", null, 'audio')?>" });
        password.add( Validate.Length, { minimum: 4, maximum: 20 } );
        
        $('#register_form').submit(function() {
            var y =$('#sf_guard_user_birthday_year').val();
            var m =$('#sf_guard_user_birthday_month').val()-1;
            var d =$('#sf_guard_user_birthday_day').val();

           
            var cumple = new Date(Date.UTC(y,m,d,'00','00','00'));
            var timestamp_cumple = cumple.getTime();
            
            var Stamp =new Date();
            var timestamp_actual = Stamp.getTime();
            var year_actual = Stamp.getYear();
            var month_actual = Stamp.getMonth();
            var day_actual = Stamp.getDate();
            if (year_actual < 2000) year_actual = 1900 + year_actual;
            var ny = year_actual-18;
            var date_18 = new Date(Date.UTC(ny,month_actual,day_actual,'00','00','00'));
            var timestamp_valido = date_18.getTime();
            
            if(timestamp_cumple  < timestamp_valido){
            }else{
                jQuery.facebox({ div: '#box' });
             return false
            }
           
        })
        
    
    });
</script>
<div id="box" style="display: none;"><span class="access_denied"><i></i><?php echo __('You must be over 18 years', null, 'pubs')?></span></div>
<form id="register_form" action="<?php echo url_for('@sf_guard_register') ?>" method="post">
<?php echo $form->renderGlobalErrors() ?>
    <!--          <div class="rows">
                  <span class="label" >Fist name :	</span>
                  <span class="value" ><?php //echo $form['first_name']->render()  ?></span>
              </div>
              <div class="rows">
                  <span class="label" >Last name :	</span>
                  <span class="value" ><?php //echo $form['last_name']->render()  ?></span>
              </div>-->
    <div class="rows">
        <span class="label" ><?php echo __('Email', null, 'sf_guard') ?> :	</span>
        <span class="value" ><?php echo $form['email_address']->renderError() ?><?php echo $form['email_address']->render() ?></span>
    </div>
    <div class="rows">
        <span class="label" ><?php echo __('Username', null, 'sf_guard') ?> :	</span>
        <span class="value" ><?php echo $form['username']->render() ?></span>
    </div>
    <div class="rows">
        <span class="label" ><?php echo __('Password', null, 'sf_guard') ?> :	</span>
        <span class="value" ><?php echo $form['password']->render() ?></span>
    </div>
    <div class="rows">
        <span class="label" ><?php echo __('Sex', null, 'sf_guard') ?> :	</span>
        <span class="value" ><?php echo $form['sex']->render() ?></span>
    </div >
    <div class="rows">
        <span class="label" ><?php echo __('Birthday', null, 'sf_guard') ?> :	
            <?php if ($form['birthday']->hasError()): ?>
                <ul class="error_list">
                    <?php foreach ($form['birthday']->getError() as $error): ?>
                        <li><?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </span>
        <span class="value" ><?php echo $form['birthday']->render() ?> + 18</span>


    </div>
    <?php echo $form->renderHiddenFields(); ?>
    <div class="submit_register">
        <input type="submit" name="<?php echo __('Sign up', null, 'sf_guard') ?>" class="submit" style="margin-left: 270px;" value="<?php echo __('Sign up', null, 'sf_guard') ?>" />
    </div>

    
</form>