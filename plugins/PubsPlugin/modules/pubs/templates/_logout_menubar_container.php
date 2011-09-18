<?php if (!$sf_user->isAuthenticated()) { ?>
    <script>
        /*variable que toma el app_base_url*/
        var base_url = '<?php echo sfConfig::get('app_base_url'); ?>';
        $(document).ready(function()
        {
                       
                        
            $('.sec').click(function(key){   
                if($(this).attr('rel') == "about_us"){
                    if($('.p').css('display')=="block"){
                        $('.p').toggle('slow');
                    }
                    if($('.c').css('display')=="block"){
                        $('.c').toggle('slow');
                    }
                    if($('.s').css('display')=="block"){
                        $('.s').toggle('slow');
                    }
                    if($('.a').css('display')=="block"){
                        $('.a').toggle('slow');
                    }
                    if($('.contact').css('display')=="block"){
                        $('.contact').toggle('slow');
                    }
                    $('.b').toggle('slow');
                }
                                    
                if($(this).attr('rel') == "about"){
                    if($('.b').css('display')=="block"){
                        $('.b').toggle('slow');
                    }
                    if($('.p').css('display')=="block"){
                        $('.p').toggle('slow');
                    }
                    if($('.c').css('display')=="block"){
                        $('.c').toggle('slow');
                    }
                    if($('.s').css('display')=="block"){
                        $('.s').toggle('slow');
                    }
                    if($('.contact').css('display')=="block"){
                        $('.contact').toggle('slow');
                    }
                    $('.a').toggle('slow');
                }
                                    
                if($(this).attr('rel') == "privacy"){    
                    if($('.a').css('display')=="block"){
                        $('.a').toggle('slow');
                    }
                    if($('.b').css('display')=="block"){
                        $('.b').toggle('slow');
                    }
                    if($('.c').css('display')=="block"){
                        $('.c').toggle('slow');
                    }
                    if($('.s').css('display')=="block"){
                        $('.s').toggle('slow');
                    }
                    if($('.contact').css('display')=="block"){
                        $('.contact').toggle('slow');
                    }
                    $('.p').toggle('slow');
                }
                if($(this).attr('rel') == "conditions"){    
                    if($('.a').css('display')=="block"){
                        $('.a').toggle('slow');
                    }
                    if($('.b').css('display')=="block"){
                        $('.b').toggle('slow');
                    }
                    if($('.p').css('display')=="block"){
                        $('.p').toggle('slow');
                    }
                    if($('.s').css('display')=="block"){
                        $('.s').toggle('slow');
                    }
                    if($('.contact').css('display')=="block"){
                        $('.contact').toggle('slow');
                    }
                    $('.c').toggle('slow');
                }
                if($(this).attr('rel') == "service"){    
                    if($('.a').css('display')=="block"){
                        $('.a').toggle('slow');
                    }
                    if($('.b').css('display')=="block"){
                        $('.b').toggle('slow');
                    }
                    if($('.p').css('display')=="block"){
                        $('.p').toggle('slow');
                    }
                    if($('.contact').css('display')=="block"){
                        $('.contact').toggle('slow');
                    }
                    if($('.c').css('display')=="block"){
                        $('.c').toggle('slow');
                    }
                                      
                    $('.s').toggle('slow');
                }
                if($(this).attr('rel') == "contact"){    
                    if($('.a').css('display')=="block"){
                        $('.a').toggle('slow');
                    }
                    if($('.b').css('display')=="block"){
                        $('.b').toggle('slow');
                    }
                    if($('.p').css('display')=="block"){
                        $('.p').toggle('slow');
                    }
                    if($('.c').css('display')=="block"){
                        $('.c').toggle('slow');
                    }
                    if($('.s').css('display')=="block"){
                        $('.s').toggle('slow');
                    }
                                      
                    $('.contact').toggle('slow');
                }
                            
            });
            $('#tab-signin').click(function(){
                if($('#tab-signin').hasClass('open')){
                    $('#tab-signin').removeClass('open')
                }else{
                    $('#tab-signin').addClass('open');
                }
                
                $('#menu-dropdown').toggle();
                $('#signin_username').focus();
     
                    
            });
            //            $('#signin_username').blur(function(){
            //                if (!$("#signin_password").is(":focus")) {
            //                    $('#menu-dropdown').toggle();
            //                }   
            //            })
            //            $()
                             
        });
        function expandLink(div, url){
            $.get(base_url+'link/iframeExpand?url='+url, function(info){     
                $('#'+div).show('slow').html(info);
                           
            });
        }
    </script>
    <div class="globalheader" id="globalheader">
        <a href="<?php echo sfConfig::get('app_base_url') ?>">
            <?php echo image_tag('/PubsPlugin/images/logo-nordestelabs_white_thumb.png', 'align=left border=0') ?>
        </a>
        <div class="tabs-header sec" rel="about_us"><?php echo __('About us', null, 'nordestelabs') ?></div>
        <div class="tabs-header sec" rel="about"><?php echo __('Social SandBox Project', null, 'nordestelabs') ?></div>
        <div class="tabs-header sec" rel="contact"><?php echo __('Contact', null, 'nordestelabs') ?></div>
        
        <div  id="sign_in">
            <div class="tabs-header" id="tab-signin" rel="about" style="float: right"> <span style="font-size: 9px" ><?php echo __('Have an acount ?', null, 'sf_guard') ?></span> <?php echo __('Sign in', null, 'sf_guard') ?></div>
            <ul id="menu-dropdown" >
                <li><?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?></li>
            </ul>
        </div>
        <div class="tabs-header" id="tab-signup" rel="about" style="float: right"><a href="/guard/register"><?php echo __('Sign up', null, 'sf_guard') ?></a></div>

    </div>
<?php } ?>