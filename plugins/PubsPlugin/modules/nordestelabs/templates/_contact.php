<script>
    $(document).ready(function()
    {
        var sender = new LiveValidation('contact_sender',{validMessage: "ok"});
        sender.add( Validate.Presence );
        sender.add( Validate.Email );
        
        $('#form_contact').submit(function(key){
            $('#loading').show();
            var msj = $('#contact_description').val();
            var sender = $('#contact_sender').val();
            $.get(base_url+"nordestelabs/contact?sender="+sender+"&msj="+msj,function(data){
                $('#form_contact').hide();
                $('#notice').append(data);
            });
            return false;
        });
 
    });
</script>
<h1><?php echo __('Contact with us', null, 'nordestelabs') ?></h1>
<div id="notice"></div>  
<form name="form_contact"  id="form_contact" class="form_contact" action="<?php echo url_for('nordestelabs/contact') ?>" method="post" enctype="multipart/form-data">
    <div>
        <div class="dialog-body">
                      
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr <?php if ($form['sender']->renderError())
    echo 'class="error"' ?>>
                    <td >
                        <span class="label <?php if ($form['sender']->renderError())
                    echo "error" ?>">
                            <?php echo __('Your email address', null, 'nordestelabs') ?>&nbsp;&nbsp;
                        </span>
                    </td>
                    <td>
                        <?php echo $form['sender']->render() ?>
                    </td>          
                </tr>  

                <tr <?php if ($form['description']->renderError())
                            echo 'class="error"' ?>>
                    <td valign="top">
                        <span class="label"> <?php echo __('Your Message', null, 'nordestelabs') ?>&nbsp;&nbsp;</span>
                    </td>
                    <td>
                        <?php echo $form['description']->render() ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td align="right"><br/>
                        <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span>&nbsp;&nbsp;
                        <input class="button" id="submit"  type="submit" value="<?php echo __('Send', null, 'nordestelabs') ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php echo $form->renderHiddenFields(); ?>
</form>
