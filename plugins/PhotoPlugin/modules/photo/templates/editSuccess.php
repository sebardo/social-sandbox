<style type="text/css">
    #edicion{
        margin:10px;
    }
    #edicion>div{
        float:left;
    }
    input[type=submit],input[type=button],input[type=reset]{
        margin: 15px 5px;
        float:right;
    }
</style>
<script type="text/javascript">
    var urlEditTitulo='<?php echo url_for('imagen/editTitulo'); ?>';
    var urlEditCoords='<?php echo url_for('imagen/editCoords'); ?>';
    var _userId='<?php echo $user['sf_id']; ?>';
    var jcrop_api;

    $(document).ready(function(){
        var $foto=$('#foto');//hacer un componente con este archivo e incluirlo en el index y en el show
        var $preview=$('#preview');
        var $edicion=$('#edicion');
        var $x1=$('#x1');
        var $y1=$('#y1');
        var $x2=$('#x2');
        var $y2=$('#y2');
        function showCoords(c){
            var x1=c.x.toString();
            var y1=c.y.toString();
            var x2=c.x2.toString();
            var y2=c.y2.toString();
            $x1.val(x1);
            $y1.val(y1);
            $x2.val(x2);
            $y2.val(y2);
            showPreview(c);
        };
        function showPreview(coords){
            if (parseInt(coords.w) > 0){
                var rx = parseInt($preview.parent().outerWidth()) / coords.w;
                var ry = parseInt($preview.parent().outerHeight()) / coords.h;
                $preview.css({
                    width: Math.round(rx * $foto.outerWidth()) + 'px',
                    height: Math.round(ry * $foto.outerHeight()) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
            }
        }
        $('#coordsImg').submit(function(){
            $.post(urlEditCoords, {
                x1:$x1.val(),
                y1:$y1.val(),
                x2:$x2.val(),
                y2:$y2.val(),
                imagenId: $edicion.attr('rel')
            },
                function(){

            });
            jcrop_api.destroy();
            return false;
        });
        $('#coordsImg').click(function(){
            $(this).reset();
            jcrop_api.destroy();
            return true;
        });

        jcrop_api=$.Jcrop('#foto');
        jcrop_api.setOptions({ aspectRatio: 1 ,onSelect:showCoords,onChange:showCoords});
        jcrop_api.setSelect([0,0,200,200]);
//        jcrop_api.animateTo(getRandom());
    });

</script>
<?php include_component("home", "menu2", array('t' => $t)); ?>
<div id="contenedor">
    <div id="principal">
        <div id="edicion" rel="<?php echo $imagen->getId();?>">
            <div>
                <?php echo image_tag($imagen->getRuta('big', $user), 'title=' . $imagen->getTitle() . ' alt=' . $imagen->getTitle() . ' id=foto height=300'); ?>
            </div>
            <div>
                <div style="width:250px;height:250px;overflow:hidden;margin-left: 10px;">
                    <?php echo image_tag($imagen->getRuta('big', $user), 'title=' . $imagen->getTitle() . ' alt=' . $imagen->getTitle() . ' id=preview height=300'); ?>

                </div>
                <form name="coords" id="coordsImg">
                    <input type="hidden" id="x1" name="x1" />
                    <input type="hidden" id="y1" name="y1" />
                    <input type="hidden" id="x2" name="x2" />
                    <input type="hidden" id="y2" name="y2" />
                    <input type="submit" value="Guardar" />
                    <input type="reset" value="Cancelar" id="cancel" />
                </form>
            </div>
        </div>
    </div>
</div>
