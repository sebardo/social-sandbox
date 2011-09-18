$(document).ready(function()
    {   
        var sending=false;
    
        $('.button').click(function(e){
            if(!sending){
                sending=true;
                $('#loading').show();   
                var yo = $(this);
                var user_id = yo.attr('user-id');
                var follow_id = yo.attr('follow-id');

        
                if(yo.hasClass('profile-follow-button')){  
                    $.get(base_url+"follow/Following?user_id="+user_id+"&follow_id="+follow_id,
                        function(data){
                            yo.parent().parent().find('#cancel').css('display','inline-block');   
                            yo.parent().parent().find('#cancel').find('.you-follow').css('display','inline-block'); 
                            yo.parent().parent().find('#enable').css('display','none');
                            $('#loading').hide();
                            sending=false;
                        });
                }
                if(yo.hasClass('profile-unfollow-link')){
                    $.getJSON(base_url+"follow/Following?user_id="+user_id+"&follow_id="+follow_id+"&cancel=ok",
                        function(data){
                            yo.removeClass('profile-unfollow-link');
                            yo.addClass('profile-follow-button');
                            yo.find('.you-follow').css('display','none');
                            yo.find('.plus').css('display','');
                            yo.find('.wrapper').css('display','none')
                            yo.find('.no-follow').css('display','')
                    
                            yo.parent().parent().find('#cancel').css('display','none');                          
                            yo.parent().parent().find('#enable').css('display','inline-block');
                            yo.find('.plus').css('display','inline-block');
                            yo.find('.no-follow').css('display','inline-block');
                            $('#loading').hide();
                            sending=false;
                        });
                }
                if(yo.hasClass('request-unfollow-link')){
                    $.getJSON(base_url+"follow/Following?user_id="+user_id+"&follow_id="+follow_id+"&cancel=ok",
                        function(data){
                            yo.removeClass('profile-unfollow-link');
                            yo.addClass('profile-follow-button');
                            yo.find('.you-follow').css('display','none');
                            yo.find('.plus').css('display','');
                            yo.find('.wrapper').css('display','none')
                            yo.find('.no-follow').css('display','')
                    
                            yo.parent().parent().find('#cancel').css('display','none');                          
                            yo.parent().parent().find('#enable').css('display','inline-block');
                            yo.find('.plus').css('display','inline-block');
                            yo.find('.no-follow').css('display','inline-block');
                    
                            $('#loading').hide();
                            sending=false;
                        });
                }
            }
        });
    });
