<?php if ($sf_user->isAuthenticated()):?>
<?php use_stylesheet('/PhotoPlugin/css/nyroModal.css');?>
<?php use_stylesheet('/PhotoPlugin/css/galery.css');?>
<?php use_javascript('/PhotoPlugin/js/jquery.nyroModal.custom.js');?>
<style type="text/css">
    #profilePhoto{position:relative;width:150px;}
    #profilePhoto img{clip: rect(0px, 150px, 150px, 0px); position: relative;top: 0; left: 0;}
    #addProfilePhoto{display: none;position: absolute;top:0;right: 0;cursor: pointer;color:white;background-color: black;padding: 3px;font-size: .8em;}
    #addProfilePhoto:hover{text-decoration: underline;}
    #contFormPhotoProfile{
        display: none;
        padding: 15px;
        position: absolute;
        z-index: 10000;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-box-shadow: 0 0 5px 2px #CCCCCC inset, 2px 2px 5px 0px #000000;
        -webkit-box-shadow: 0 0 5px 2px #CCCCCC inset, 2px 2px 5px 0px #000000;
        box-shadow: 0 0 5px 2px #CCCCCC inset, 2px 2px 5px 0px #000000;
        background: #EEEEEE;
        border: 1px solid #CCCCCC;
    }
    #contFormPhotoProfile input[type=file]{
            width: auto;
        }
        #nyroModalFull,.nyroModalClose, .nyroModalBg, .nyroModalCont{z-index: 10000}
</style>

<div id="profilePhoto">
    <?php echo image_tag($sf_user->getGuardUser()->getImage(), 'width=150px'); ?>
    <span id="addProfilePhoto" ><?php echo __('Upload profile image', null, 'photo')?></span>
</div>

<div id="contFormPhotoProfile">
    <?php include_partial('photo/form', array('form' => new photoForm(),'isProfile'=>true)); ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var addPhotoVisible=           false;
        var $profilePhoto =            $('#profilePhoto')
        var $contFormPhotoProfile=     $('#contFormPhotoProfile');
        var $addProfilePhoto=          $('#addProfilePhoto');
        var $formPhotoProfileCancel=   $contFormPhotoProfile.find('#cancel');
        var $formPhoto=                $('#formProfilePhoto');

        $profilePhoto.hover(
        function(){
            $addProfilePhoto.slideDown('fast')
        },
        function(){
            $addProfilePhoto.slideUp('fast')
        });

        $addProfilePhoto.click(function(e){
            if(!addPhotoVisible){
                addPhotoVisible=true;
                var $body=$('body');
                $contFormPhotoProfile.css({
                    position:'absolute',
                    left:e.pageX,
                    top:e.pageY
                });
                $contFormPhotoProfile.animate({
                    opacity: 'toggle',
                    height: 'toggle',
                    left:($(this).parents('.pubs-header').outerWidth()-$contFormPhotoProfile.outerWidth())/2,
                    top:100
//                    top:Math.max(($body.outerHeight()-$contFormPhotoProfile.outerHeight())/2,20)
                }, 'slow');
            }
        });
        $formPhotoProfileCancel.click(function(){
            $contFormPhotoProfile.fadeOut('fast', function(){addPhotoVisible=false;})
        });
        $formPhoto.nyroModal({
        closeOnClick: false,
        callbacks:{
            beforeShowCont:function(result){
                if(!result.elts.cont.find('#noPhoto').html()){
                    $formPhotoProfileCancel.click();
                    var imageSrc=result.elts.cont.find('#previewPhoto img').attr('src');
                    $profilePhoto.find('img').attr('src', imageSrc);
                }
            }
        }
    });
    });
</script>
<?php endif;?>