jQuery.fn.extend({
    formateaFecha: function(){
        this.each(function(){
            if(jQuery(this).val().indexOf('-')!=(-1)){
                var fecha_arr =jQuery(this).val().split('-');
                jQuery(this).val(fecha_arr[1]+'/'+fecha_arr[2]+'/'+fecha_arr[0]);
            }
        });
    },
    cambiaOverflow: function cambiaOverflow(){
        jQuery(this).hover(
            function(){
                jQuery(this).css({
                    'overflow':'auto'
                });
            },
            function(){
                jQuery(this).css({
                    'overflow':'hidden'
                });
            });
    },
    cargando : function (options){
        var defaults = {
            urlAjaxLoaderImage:base_url+'/images/cargandoAjax.gif'
        }
        var opts=jQuery.extend(defaults, options);
        var $cont = $(this);

        var html='<div  class="cargador"></div><img class="imageCarg" src="'+opts.urlAjaxLoaderImage+'"/>';
        $cont.append(html);
//        var anchoTablaEvento = $('.tablaLista').outerWidth()+((20/100)*$('.tablaLista').outerWidth());
        var $cargadorAjax=$cont.find('.cargador');
        var $imageCargador=$cont.find('.imageCarg');
        var ancho = $imageCargador.outerWidth();
        var anchoCont = $cont.outerWidth();
        var centroH = (anchoCont - ancho)/2;
        var alto = $imageCargador.outerHeight();
        var altoCont = $cont.outerHeight();
        var centroV = (altoCont - alto)/2;
//        $(this).parent().css({
//          'overflow': 'hidden'
//          });
        $imageCargador.css({
            'left': centroH+'px',
            'top': centroV+'px'
            });
//        $cargadorAjax.css({
//            'width': anchoTablaEvento+'px'
//        });
        $cargadorAjax.fadeTo('slow',.3);
    },
    cargaTerminada : function(){
        var $cargadorAjax=$(this).find('.cargador');
        var $imageCargador=$(this).find('.imageCarg');
        $cargadorAjax.fadeTo('slow',0);
        $cargadorAjax.remove();
        $imageCargador.remove();
    },
    getValorHref: function(variable){
        var url = $(this).attr('href');
        var search = url.substring(url.indexOf('?')+1);
        var pares = search.split('&');
        for (i=0;i<pares.length;i++){
            var actual = pares[i].split('=');
            if(actual[0]==variable){
                return actual[1];
            }
        }
        //        alert('no existe');
        return false;
    },
    creaLinksPaginacion: function (_user,url,_id){
        var $yo=$(this);
        var links= this.find('.paginacion a');
        links.each(function(){
            $(this).click(function(){
                var pagina=$(this).getValorHref('page');
                $yo.cargando()
                $.get(url, {
                    page:pagina,
                    user:_user,
                    id:_id
                }, function(result){
                    $yo.html(result);
                    $yo.creaLinksPaginacion(_user,url,_id);
                    $yo.find('.tablaLista').css('display', 'inline');
//                   $yo.css({
//                      'overflow': 'auto'
//                      });

                });
                return false;
            });
        });
        return false;
    },
    reset : function () {///Reseteo de formularios
        $(this).each (function() {
            $(this).find('[type=reset]').click();
        });
    }
});
