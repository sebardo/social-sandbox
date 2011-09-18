<link href="<?php echo sfConfig::get('app_base_url'); ?>InboxPlugin/css/inbox.css" media="screen" type="text/css" rel="stylesheet">
<link href="<?php echo sfConfig::get('app_base_url'); ?>sfFormExtraPlugin/css/jquery.autocompleter.css" media="screen" type="text/css" rel="stylesheet">
<script src="<?php echo sfConfig::get('app_base_url'); ?>sfDoctrineGuardPlugin/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="<?php echo sfConfig::get('app_base_url'); ?>sfFormExtraPlugin/js/jquery.autocompleter.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
<?php if ($sf_request->getParameter('user')) { ?>
    <?php $guard = Doctrine::getTable('sfGuardUser')->findOneBy('username', $sf_request->getParameter('user')); ?>
                var user = '<?php echo $sf_request->getParameter('user') ?>';
                $.get("/inbox/getUsers?q="+user, function(data){                    
                    for(var key in data){            
                        var r = data[key].split(">");
                    }                       
                    $('#autocomplete_inbox_dest_user_id').val(r[1]);
                    $('#inbox_dest_user_id').val(<?php echo $guard['id'] ?>);
                });
<?php } ?>
        $('#loading',window.parent.document).hide();
        $('#autocomplete_inbox_dest_user_id').result(function(event, data, formatted){
            var string = data[0];
            var r = string.split(">");
            $('#autocomplete_inbox_dest_user_id').val(r[1]);
        });
        $('#form_new_message').submit(function(){
            $('#loading').show();
        });
    })
  
</script>
<body style="background: transparent">
    <div class="new_message" >
        <form name="form_new_message" id="form_new_message" class="form_new_message" action="<?php echo url_for('inbox/create') ?>" method="post" enctype="multipart/form-data">
            <div>
                <div class="dialog-body">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr <?php if ($form['dest_user_id']->renderError())echo 'class="error"' ?>>
                            <td >
                                <span class="label <?php if ($form['dest_user_id']->renderError()) echo "error" ?>">
                                    <?php echo __('To', null, 'inbox') ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $form['dest_user_id']->render(array("size" => "40")) ?>
                            </td>          
                        </tr>  

                        <tr >
                            <td>
                                <span class="label <?php if ($form['title']->renderError())
                                    echo "error" ?>">
                                    <?php echo __('Subject', null, 'inbox') ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $form['title']->render() ?>
                                <span class="error">
                                    <?php if ($form['title']->renderError())
                                        echo $form['title']->renderError() ?>
                                </span>
                            </td>
                        </tr>
                        <tr <?php if ($form['description']->renderError()) echo 'class="error"' ?>>
                            <td valign="top">
                                <span class="label"> <?php echo __('Message', null, 'inbox') ?>&nbsp;&nbsp;</span>
                            </td>
                            <td>
                                <?php echo $form['description']->render() ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td align="right"><br/>
                                <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span>&nbsp;&nbsp;<input class="button"  type="submit" value="<?php echo __('Send', null, 'inbox') ?>" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php echo $form->renderHiddenFields(); ?>
        </form>

    </div>
</body>