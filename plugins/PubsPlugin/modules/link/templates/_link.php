<?php if (isset($edit)) {
    if ($edit == true): ?>
        <?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/jquery.jeditable.js') ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $.editable.addInputType('autogrow', {
                    element : function(settings, original) {
                        var textarea = $('<textarea>');
                        if (settings.rows) {
                            textarea.attr('rows', settings.rows);
                        } else {
                            textarea.height(settings.height);
                        }
                        if (settings.cols) {
                            textarea.attr('cols', settings.cols);
                        } else {
                            textarea.width(settings.width);
                        }
                        $(this).append(textarea);
                        return(textarea);
                    }
                });

                $(".title").editable('<?php echo sfConfig::get('app_base_url') ?>link/editTitle', {
                    indicator : "Saving...",
                    tooltip   : "Click to edit...",
                    onblur    : 'submit',
                    submitdata : function(value, settings) {
                                                       
                        if($(this).debugMode)console.info('Edit title ... ');
                        return {
                                                          
                        };
                    }
                });
                $(".description").editable('<?php echo sfConfig::get('app_base_url') ?>link/editDesc', {
                    type      : "autogrow",
                    indicator : "Saving...",
                    tooltip   : "Click to edit...",
                    onblur    : 'submit',
                    submitdata : function(value, settings) {
                                                       
                        if($(this).debugMode)console.info('Edit description ... ');
                        return {
                                                          
                        };
                    },
                    autogrow : {
                        lineHeight : 16,
                        maxHeight  : 512
                    }
                });
                                  
            });
        </script>
    <?php endif; ?>
<?php } ?>
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
    <?php echo image_tag($image, "align=left") ?>
    <?php echo utf8_decode($title) ?></br>
    <?php echo $site_name ?></br>
    <?php echo @$description ?>
<?php } else { ?>
    <?php $x = rand(0, 999999) ?>
    <a id="<?php echo $x ?>" class="pub-link" 
    <?php if ($link->getSiteName() == 'Vimeo' || $link->getSiteName() == 'YouTube') { ?>
           onclick="expandLink('<?php echo $x ?>','<?php echo $link->getUrl() ?>')"
       <?php } else { ?>
           href="<?php echo $link->getUrl() ?>" target="_blank"
       <?php } ?>
       >
        <div class="pub-link-image"><?php echo image_tag($link->getImage(), "align=left width=130") ?>
            <?php if ($link->getSiteName() == 'Vimeo' || $link->getSiteName() == 'YouTube') { ?>
                <i></i>
            <?php } ?>
        </div>
        <div class="pub-link-text">
            <div id="<?php echo $link->getId() ?>" class="title"><?php echo utf8_decode($link->getTitle()) ?></div>

            
                <?php echo $link->getSiteName() ?>
                <div id="<?php echo $link->getId() ?>" class="description"><?php echo @$link->getDescription() ?></div>
              
        </div>
    </a>
<?php } ?>