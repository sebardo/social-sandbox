<script language="javascript">
    $(document).ready(function()
    {
        $('.prompt-ok').click(function(key){
   
            var model = '<?php echo $sf_request->getParameter('record_model') ?>';
            var id = '<?php echo $sf_request->getParameter('record_id') ?>';
            var elem = '<?php echo $sf_request->getParameter('div_id') ?>';
            $.get(base_url+"pubs/deletePub?model="+model+"&id="+id,
            function(data){
                $('#facebox',window.parent.document).fadeOut(function() {
                    $('#facebox .loading').remove()
                    $("#facebox_overlay").remove()
                    $(document).trigger('afterClose.facebox')
                })
                $('#'+elem).hide('slow');
            });
            
            return false;
        });
        $('.prompt-cancel').click(function(key){
            $('#facebox',window.parent.document).fadeOut(function() {
                $('#facebox .loading',window.parent.document).remove()
                $("#facebox_overlay",window.parent.document).remove()
                $(document,window.parent.document).trigger('afterClose.facebox')
            })    
        });
    });
</script> 
<div class="dialog-header">
    <?php if( $sf_request->getParameter('record_model')=="comment"){?>
         <h2>Are you sure you want to delete this comment?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="pubs"){?>
         <h2>Are you sure you want to delete this pub?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="audio"){?>
         <h2>Are you sure you want to delete this audio?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="playlist"){?>
         <h2>Are you sure you want to delete this playlist?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="event"){?>
         <h2>Are you sure you want to delete this event?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="photo"){?>
         <h2>Are you sure you want to delete this photo?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="album_photo"){?>
         <h2>Are you sure you want to delete this album?</h2>
    <?php } ?>
     <?php if( $sf_request->getParameter('record_model')=="favlike"){?>
         <h2>Are you sure you want to delete this favelike?</h2>
    <?php } ?>
</div>
<div class="dialog-inside">
    <div class="facebox-body">
        <div class="dialog-content">
            <div class="prompt">
                <div class="button prompt-ok selected">Yes</div>
                <div class="button prompt-cancel">No</div>
            </div>
        </div>
    </div>
    <div class="twttr-dialog-footer clearfix" style="display: none;">

    </div>
</div>
