<script>
    $(document).ready(function($) {
        $('#loading').show();
        $.get(base_url+"search/list?sex=", function(info){
            $('.search_right').show('slow').html(info);
            $('#loading').hide();
        });
        
       
        $('.sex').change(function(e){
            var str = "";
            $("select.sex option:selected").each(function () {
                //                str += $(this).val() + " ";
                str = $(this).val();
            });
            $('#update').attr('sex',str)
        })
        .trigger('change');
        
        $('.minAge').change(function(e){
            var str = "";
            $("select.minAge option:selected").each(function () {
                str = $(this).val();
            });
            $('#update').attr('minAge',str) 
        })
        .trigger('change');
        
        $('.maxAge').change(function(e){
            var str = "";
            $("select.maxAge option:selected").each(function () {
                str = $(this).val();
            });
            $('#update').attr('maxAge',str) 
        })
        .trigger('change');
        
        $('.country').change(function(e){
            var str = "";
            $("select.country option:selected").each(function () {
                str = $(this).val();
            });
            $('#update').attr('country',str) 
        })
        .trigger('change');
        
        $('#update').click(function(e){
            $('#loading').show();
            var sex = $(this).attr('sex');
            var minAge = $(this).attr('minAge');
            var maxAge = $(this).attr('maxAge');
            var country = $(this).attr('country');
            $.get(base_url+"search/list?sex="+sex+"&minAge="+minAge+"&maxAge="+maxAge+"&country="+country, function(info){
                $('.search_right').html(info);
                $('#loading').hide();
            });
        
        })
        

    });  
</script>

<div id="searchContainer">
    <div class="search_left" >
        <?php include_partial('left', array('datos' => $datos, 'form' => $form)); ?>
    </div>
    <div class="search_right" >
    </div>
</div>
