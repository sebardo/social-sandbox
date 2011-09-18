<script language="javascript">
    $(document).ready(function()
    {
        $('.share').click(function(key){

            var url = $(this).attr('data-url');
            window.open(url,'Share on Social Sandbox','width=500,height=300,scrollbars=NO')
        
        });
        $('.prompt-cancel').click(function(key){
            $('#facebox',window.parent.document).fadeOut(function() {
                $('#facebox .loading',window.parent.document).remove()
                $("#facebox_overlay",window.parent.document).remove()
                $(document,window.parent.document).trigger('afterClose.facebox')
            })    
        });
        
        $("#sharebyMail").click(function() {
            var yo = $(this);
            var url = yo.attr('data-url');
            if($('#shareFrame').length == 0){
                var testFrame = document.createElement("IFRAME");
                testFrame.id = "shareFrame";
                testFrame.src = "<?php echo sfConfig::get('app_base_url') ?>pubs/sharebyMail?url="+url;
                $('.prompt').after(testFrame);
            }else{
                $('#shareFrame').remove();
            }
        });
    });
    
</script> 

<div class="dialog-header">
    <?php if ($sf_request->getParameter('url')) { ?>
        <h2>Share this whit</h2>
    <?php } ?>

</div>
<div class="dialog-inside">
    <div class="facebox-body">
        <div class="dialog-content">
            <div class="content" style="width: 400px"> 
                <?php if (isset($url)) { ?>
                    <?php foreach ($graph as $key => $value) { ?>
                        <?php if ($key == 'title') { ?>
                            <?php $title = $value ?>
                        <?php } ?>
                        <?php if ($key == 'desciption') { ?>
                            <?php $description = $value ?>
                        <?php } ?>
                        <?php if ($key == 'site_name') { ?>
                            <?php $site_name = $value ?>
                        <?php } ?>
                        <?php if ($key == 'url') { ?>
                            <?php $url = $value ?>
                        <?php } ?>
                        <?php if ($key == 'image') { ?>
                            <?php $image = $value ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo image_tag($image, "align=left width=70") ?>
                    <?php echo utf8_decode($title) ?></br>
                    <?php echo $site_name ?></br>
                    <?php echo @$description ?>
                <?php } ?>

            </div>
            <div class="prompt" style="display: block;overflow: hidden; padding: 5px;">
                <div id="sharebyMail" data-url="<?php echo $sf_request->getParameter('url') ?>"><i class="email"></i></div>
                <div class="pub-info share" id="share" data-url="http://www.facebook.com/sharer/sharer.php?u=<?php echo $sf_request->getParameter('url') ?>"><i class="facebook" ></i></div>
                <div class="pub-info share" id="share" data-url="https://twitter.com/intent/tweet?url=<?php echo $sf_request->getParameter('url') ?>&text=I%20recommend%20you%20see%20this%20link&via=social%20sandbox"><i class="tweeter" ></i></div>
                <div class="pub-info share" id="share" data-url='http://www.linkedin.com/shareArticle?url=<?php echo $sf_request->getParameter('url') ?>&amp;mini=true' title='Compartir en Linkedin ' ><i class="linkedin"></i></div>
                <div class="pub-info share" id="share" data-url="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $sf_request->getParameter('url') ?>"><i class="myspace"></i></div>
            </div>
        </div>
    </div>
    <div class="twttr-dialog-footer clearfix" style="display: none;">

    </div>
</div>
