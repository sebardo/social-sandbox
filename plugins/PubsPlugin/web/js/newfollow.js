$(document).ready(function(){  
     
    $('a[rel*=facebox]').facebox({
        });
    var sending=false;
    $('.follow-link').click(function() {
        if(!sending){
            sending=true;
            var id = $(this).attr('rel');
            $.get(base_url+"follow/activateFollowing?id="+id, function(info){
                $('#new-following-'+id).toggle('slow');
                //                jQuery.facebox('The request have been acepted');
                jQuery.facebox({
                    div: '#accepted'
                });
                $('#facebox').delay(1500).fadeOut(function() {
                    $('#facebox .loading').remove()
                    $("#facebox_overlay").remove()
                    $(document).trigger('afterClose.facebox')
                    sending=false;
                })
                
            });
        }
        
    });
    $('.unfollow-link').click(function() {
        if(!sending){
            sending=true;
            var id = $(this).attr('rel');
            $.get(base_url+"follow/deleteFollowing?id="+id, function(info){
                $('#new-following-'+id).toggle('slow');
                jQuery.facebox({
                    div: '#rejected'
                });
                $('#facebox').delay(1500).fadeOut(function() {
                    $('#facebox .loading').remove()
                    $("#facebox_overlay").remove()
                    $(document).trigger('afterClose.facebox')
                    sending=false;
                })
            });
        }
    });
});     
