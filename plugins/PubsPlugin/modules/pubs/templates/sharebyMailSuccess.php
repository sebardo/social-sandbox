<?php include_stylesheets()?>
<script src="<?php echo sfConfig::get('app_base_url'); ?>sfDoctrineGuardPlugin/js/jquery-1.4.2.js" type="text/javascript"></script>
<style>
    #input{
        border: 1px solid grey;
        border-radius: 4px 4px 4px 4px;
        color: #444444;
        height: 25px;
        width: 290px;
        margin-bottom: 1px;

    }
    #input_description{
        border: 1px solid grey;
        border-radius: 4px 4px 4px 4px;
        width: 290px;
    }
    i.ok{
        background-image: url("/PubsPlugin/images/sprite-icons.png");
        background-position: -141px -304px;
        display: inline-block;
        height: 13px;
        margin-left: 10px;
        width: 18px;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
    <?php if ($sf_user->getFlash('message')) { ?>
                     $('#facebox',window.parent.document).animate({height:'20px'}, 500);
                     $('.pop_up',window.parent.document).animate({height:'20px'}, 500);
                     $('.content',window.parent.document).animate({height:'20px'}, 500);
                     $('#facebox',window.parent.document).find('iframe',window.parent.document).animate({height:'20px'}, 500);
                     $('#shareFrame',window.parent.document).animate({height:'20px'}, 500);
    <?php } ?>    
})
  
</script>
<body>
    <div class="new_message" >
        <?php if($sf_user->getFlash('message')){?>
              <?php echo $sf_user->getFlash('message')?> <i class="ok"></i>
        <?php }else{?>
        <form name="form_sharebyMail"  id="form_sharebyMail" class="form_sharebyMail" action="<?php echo url_for('pubs/sendShare') ?>" method="post" enctype="multipart/form-data">
            <div>
                <div class="dialog-body">
                    <table cellpadding="0" cellspacing="0" width="100%">
                         <tr <?php if ($form['sender']->renderError()) echo 'class="error"' ?>>
                            <td >
                                <span class="label <?php if ($form['sender']->renderError()) echo "error" ?>">
                                    From
                                </span>
                            </td>
                            <td>
                                <?php echo $form['sender']->render(array("size" => "40", "id" => "input")) ?>
                            </td>          
                        </tr>  
                        
                        <tr <?php if ($form['dest']->renderError()) echo 'class="error"' ?>>
                            <td >
                                <span class="label <?php if ($form['dest']->renderError()) echo "error" ?>">
                                    To
                                </span>
                            </td>
                            <td>
                              <?php echo $form['dest']->render(array("size" => "40", "id" => "input")) ?>
                            </td>          
                        </tr>  

                        
                        <tr <?php if ($form['description']->renderError()) echo 'class="error"' ?>>
                            <td valign="top">
                                <span class="label"> Message&nbsp;&nbsp;</span>
                            </td>
                            <td>
                                <?php echo $form['description']->render(array("id" => "input_description")) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td align="right"><br/>
                                <span id="loading" style="display: none"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span>&nbsp;&nbsp;<input class="button"  type="submit" value="Enviar" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php echo $form->renderHiddenFields(); ?>
        </form>
        <?php }?>
    </div>
</body>