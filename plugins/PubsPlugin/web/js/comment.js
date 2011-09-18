//var sending=false;
//$('.comments-items-form').find('textarea').unbind('keyup');
//$('.comments-items-form').find('textarea').keyup(function(e){  
//    if(!sending){
//        sending=true;
//        if(e.keyCode == 13)
//        {
//            var i = $(e.target);
//            var form  = i.parent();
//            var user_id = $(form).find('input[name=user_id]').val();
//            var dest_user_id = $(form).find('input[name=dest_user_id]').val();
//            var record_model = $(form).find('input[name=record_model]').val();
//            var record_id = $(form).find('input[name=record_id]').val();
//            var comment = i.val();
//            i.val('');
//            $.get("/comment/insertComment?user_id="+user_id+"&dest_user_id="+dest_user_id+"&record_model="+record_model+"&record_id="+record_id+"&comment="+comment,
//                function(data){    
//                    $(form).before(data);
//                     sending=false;
//                });
//        }
//    }
//});