<script language="javascript">
    $(document).ready(function()
    {
        $('.prompt-ok').click(function(key){  
            var id = '<?php echo $sf_request->getParameter('id') ?>';
            $.get(base_url+"inbox/delete?id="+id,
            function(data){
                $('#facebox',window.parent.document).fadeOut(function() {
                    $('#facebox .loading').remove()
                    $("#facebox_overlay").remove()
                    $(document).trigger('afterClose.facebox')
                })
                $('#reply-'+id).hide('slow');
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
<h2>Are you sure want delete this message ?</h2>
<div class="dialog-inside">
    <div class="dialog-body">
        <div class="dialog-content">
            <div class="prompt">
                <div class="button prompt-ok selected">Yes</div>
                <div class="button prompt-cancel">No</div>
            </div>
        </div>
    </div>
</div>

