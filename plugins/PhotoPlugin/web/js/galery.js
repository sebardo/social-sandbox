function Galery(params){
    var obj=           this;
    var urls=          params.urls;
    var traduction=    params.traduction;
    var selectors=     params.selectors;
    
    var $albums;
    var $photos;
    var $album;
    var $photo;
    var $amountPhotos;
    var $contFormPhoto;
    var $formAlbumId;
    var $formPhoto;
    var $addPhoto;
    var $addPhoto2;
    var $amountAlbums;
    var $cover;
    var $title;
    var $sortablePhoto;
    var $sortableAlbum;
    var $picture;
    var $preview;
    var $editTools;
    var $x1;
    var $y1;
    var $x2;
    var $y2;
    var $jcrop_cover;

    //propieties
    this.debugMode =       (params.debugMode)?true:false;
    this.params=           params;
    this.userId=           params.albumUserId;//album user id
    this.selectedAlbum=    {};//obcect with selected album
    this.albums=           [];//array with user albums
    this.photos=           [];//array with selectedAlbum photos
    
    //methods
    this.init=             init;
    this.getAlbum=         getAlbum;


    $addPhoto=             $(selectors.addPhoto);
    $addPhoto2=            $(selectors.addPhoto2);
    $contFormPhoto=        $(selectors.contFormPhoto);
    $formAlbumId=          $contFormPhoto.find('#photo_album_id');
    $formPhoto=            $(selectors.formPhoto);
    $sortablePhoto=        $(selectors.sortablePhoto);
    $sortableAlbum=        $(selectors.sortableAlbum);

    $formPhoto.find(':reset').click(function(){
        $contFormPhoto.hide('slow');
    });

    $addPhoto.click(function(e){
        e.preventDefault();
        var selected=(obj.selectedAlbum)?obj.selectedAlbum.id:$sortableAlbum.find('.album:eq(0)').attr('rel');
        selected= selected?selected:'';
        if(obj.debugMode)console.info((selected=='')?traduction.frase1:traduction.frase2+selected);
        $formAlbumId.val(selected);
        $contFormPhoto.show('slow');
    });

    $addPhoto2.click(function(e){
        e.preventDefault();
        $formAlbumId.val('');
        if(obj.debugMode)console.info(traduction.frase3);
        $contFormPhoto.show('slow');
    });

    $formPhoto.nyroModal({
        closeOnClick: false,
        callbacks:{
            beforeShowCont:function(result){
                $('#nyroModalFull').css('zIndex',1000);
                if(!result.elts.cont.find('#noPhoto').html()){
                    $formPhoto.find('#cancel').click();
                    var id=getFormAlbumId();
                    obj.init(id);
                }
            }
        }
    });

    function init(albumId){
        $albums=      $(selectors.albums);
        $photos=      $(selectors.photos);

        $photos.slideUp("slow");

        $.post(urls.list,{
            userId:this.userId
        },
        function(result){
            obj.albums=asignAlbums(result.albums,obj.params);
            var selectedId=albumId?albumId:getFirstKey(result.albums);
            selectedId=selectedId?selectedId:'';
            if(obj.debugMode)console.info((selectedId=='')?traduction.frase4:traduction.frase5+selectedId);
            if(selectedId){
                obj.selectedAlbum= getAlbum(selectedId);//new Album(obj.getAlbum(selectedId),obj.params);
                if(obj.debugMode)console.info(traduction.frase6+obj.selectedAlbum.name);
            }else{
                if(obj.debugMode)console.info(traduction.frase7);
            }
            $photos.find(selectors.title).attr('rel',selectedId);
            $sortablePhoto.attr('rel',selectedId);
            listAlbums(obj.albums);
            refreshAlbumTitle();
            $sortableAlbum.removeClass('ui-state-active');
            $sortableAlbum.find(selectors.album+'[rel='+obj.selectedAlbum.id+']').removeClass('ui-state-default').addClass('ui-state-active');
            $album=$(selectors.album);
            $cover=$(selectors.cover);
            $title=$(selectors.title);


            $cover.click(function(){
                var rel=$(this).parents('.album').attr('rel');
                if(rel!=obj.selectedAlbum.id){
                    if(obj.debugMode)console.info(traduction.frase8+$photos.find(selectors.title).attr('rel')+traduction.frase9+rel);
                    obj.init(rel);
                }else{
                    if(obj.debugMode)console.info(traduction.frase10+obj.selectedAlbum.name+traduction.frase11+obj.getAlbum(rel).name);
                }
                return false;
            });

            if (obj.selectedAlbum.isMine){
                    $title.editable(urls.editTitle, {
                        indicator : traduction.frase20,
                        tooltip   : traduction.frase21,
                        onblur:'submit',
                        submitdata : function(value, settings) {
                            var _albumId=$(this).attr('rel');
                            if(obj.debugMode)console.info(traduction.frase12+obj.getAlbum(_albumId).name);
                            return {
                                albumId: _albumId
                            };
                        }
                    });
                $sortableAlbum.sortable({
                    handle:'.handlerMove',
                    zIndex: 5,
                    update: function(event, ui) {
                        var ord = '';
                        $(this).add('li.album').each(function(n){
                            ord+=(n>0)?$(this).attr('rel')+'='+n+',':'';
                        });
                        var _ord=ord.substr(0, ord.length-1);
                        if(obj.debugMode)console.info(traduction.frase13+_ord);
                        $.post(urls.ordAlbum, {
                            ord:_ord,
                            userId:obj.userId
                        },function(result){});
                    }
                })
            }

            listPhotos(obj.selectedAlbum.photos);
            $photo=$(selectors.photo);

            if (obj.selectedAlbum.isMine){
                var $edit=$(selectors.photo+' .edit');
                $edit.click(function(e){
                    e.preventDefault();
                    initEdit(e);
                });
                var $setCover=$(selectors.photo+' .setCover');
                $setCover.click(function(e){
                    e.preventDefault();
                    setCover(e);
                });
                $('.setProfilePhoto').click(function(e){
                    e.preventDefault();
                    var id=$(e.target).parents('.icons').attr('rel');
                    $(e.target).fadeTo('fast', 0.3);
                    $.post(urls.setProfilePhoto,{
                        photoId:id
                    },function(result){
                        $(e.target).fadeTo('fast', 1);
                    });
                });
                $album.droppable({
                    accept: ".photo",
                    hoverClass: "ui-state-hover",
                    drop: function( event, ui ) {
                        var _albumId = $(this).attr('rel');
                        var _photoId = $(ui.draggable).attr('rel');
                        if(obj.debugMode)console.info(traduction.frase13+_photoId+traduction.frase15+_albumId);
                        $.post(urls.movePhoto, {
                            albumId:_albumId,
                            photoId:_photoId
                        },
                        function(result){
                            if(result=='1'){
                                ui.draggable.remove();
                                $photo=$(selectors.photo);
                                $amountPhotos=$(selectors.amountPhotos);
                                $amountPhotos.html($photo.length);
                                obj.init(obj.selectedAlbum.id);
                            }else{
                                alert(result);
                            }
                        });
                    }
                })
            }
            refreshAmounts();
            $photos.slideDown("slow");
        });
        
    }
    
    function asignAlbums(albums,params){
        if(obj.debugMode)console.info(traduction.frase16);
        var albumsArray=[];
        if(albums){
            for (var i in albums){
                albumsArray[i] = new Album(albums[i],params);
            }
        }
        return albumsArray;
    }

    function getFirstKey(obj){
        for (var i in obj){
            return obj[i].id;
        }
    }

    function getAlbum(id){
        for (var i in obj.albums){
            if(obj.albums[i].id==id){
                return obj.albums[i];
            }
        }
        return false;
    }

    function listAlbums(albums){
        if(obj.debugMode)console.info(traduction.frase17);
        if(albums){
            $sortableAlbum.html('');
            for (var i in albums){
                var isSelected = albums[i].id == obj.selectedAlbum.id;
                var html=albums[i].getHtmlMini();
                $sortableAlbum.append(html);
                albums[i].jq=$('.album[rel='+albums[i].id+']');
                albums[i].jq.find('.delete').click(function(e){
                    var id=$(e.target).parents('.album').attr('rel')
                    if(confirm('Are you sure?')){
                        $.post(urls.deleteAlbum, {
                            albumId:id
                        },
                        function(result){
                            if(result=='1'){
                                if(isSelected){
                                    obj.selectedAlbum={};
                                }
                                obj.init();
                            }else{
                                alert(result);
                            }
                        });
                    }
                });
            }
        }
    }

    function listPhotos(photos){
        if(obj.debugMode)console.info(traduction.frase18);
        if(photos){
            $sortablePhoto.html('');
            for (var i in photos){
                var html=photos[i].getHtmlMini();
                $sortablePhoto.append(html);
                photos[i].jq=$('.photo[rel='+photos[i].id+']');
                photos[i].jq.find('.delete').click(function(e){
                    if(confirm('Are you sure?')){
                        $.post(urls.deletePhoto, {
                            photoId:$(e.target).parents('.photo').attr('rel')
                        },
                        function(result){
                            if(result=='1'){
                                obj.init(obj.selectedAlbum.id);
                            }else{
                                alert(result);
                            }
                        });
                    }
                });
            }
            $('.galery').nyroModal({                                           //inicio la galeria
                useKeyHandler: true
            });
            $sortablePhoto.sortable({                                             //inicio el ordenamiento
                handle: '.handlerMove',
                zIndex: 6,
                update: function(event, ui) {
                    var ord = '';
                    $(this).add('li.photo').each(function(n){
                        ord+=(n>0)?$(this).attr('rel')+'='+n+',':'';
                    });
                    var _ord=ord.substr(0, ord.length-1);
                    var _albumId=$sortablePhoto.attr('rel');
                    $.post(urls.ordPhoto, {
                        ord:_ord,
                        albumId:_albumId
                    },function(result){
                        if(result != 'ok'){
                            alert(result);
                        }
                    })
                }
            }).disableSelection();
        }else{
            $sortablePhoto.html('');
        }

    }

    function refreshAlbumTitle(){
        var titulo=        obj.selectedAlbum.name ? obj.selectedAlbum.name :traduction.frase19;
        var className=     obj.selectedAlbum.isProfileAlbum?'profileTitle':'title';
        var html='<span rel="'+obj.selectedAlbum.id+'" class="'+className+'">'+titulo+'</span>';
        html +=  '(<span class="amountPhotos">0</span>)';
        $photos.find('h3').html(html);
    }

    function refreshAmounts(){
        $amountPhotos=         $(selectors.amountPhotos);
        $amountAlbums=         $(selectors.amountAlbums);
        $amountAlbums.html($album?$album.length.toString():'0');
        $amountPhotos.html($photo?$photo.length.toString():'0');
    }

    function getFormAlbumId(){
        return $formAlbumId.val();
    }

    function initEdit(e){
        $('#contContEdit').remove();
        var id=$(e.target).parents('.icons').attr('rel');
        $('body').append(obj.selectedAlbum.getPhoto(id).getHtmlEdit());
        $('#titlePicture').editable(urls.editTitlePhoto, {//                    edit TITULOS
            indicator : traduction.frase20,
            tooltip   : traduction.frase21,
            onblur:'submit',
            submitdata : function(value, settings) {
                //                    var _albumId=$(this).attr('rel');
                return {
                    photoId: id
                };
            }
        });
        $picture=$('#picture');//                                                     REDIMENSIONADO DE IMAGENES
        $preview=$('#preview');
        $contEdit=$('#contEdit');
        $x1=$('#x1');
        $y1=$('#y1');
        $x2=$('#x2');
        $y2=$('#y2');

        $('#coorsPhoto').submit(function(){
            var id=$contEdit.attr('rel');
            $.post(urls.editCoors, {
                x1:$x1.val(),
                y1:$y1.val(),
                x2:$x2.val(),
                y2:$y2.val(),
                photoId:id
            },
            function(){
                $('#contEdit').slideUp('slow',function(){
                    $(this).remove();
                });
                obj.init(obj.selectedAlbum.getPhoto(id).album_id);
            });
            $jcrop_cover.destroy();
            return false;
        });
        $('#coorsPhoto').find('#cancel').click(function(){
            $jcrop_cover.destroy();
            $('#contEdit').slideUp('fast',function(){
                $(this).remove();
            });
            return true;
        });
        $('#picture').load(function(){
            var $contContEdit=$('#contContEdit');
            var offset=$photos.offset();
            var imagenesW=$('body').outerWidth();
            var imagenesH=$('body').outerHeight();
            var centroX=e.pageX;//-offset.left;
            var centroY=e.pageY;//-offset.top;
            $contContEdit.css({
                position:'absolute',
                left:centroX,
                top:centroY
            });
            $contContEdit.animate({
                opacity: 'toggle',
                height: 'toggle',
                left:(imagenesW-$contContEdit.outerWidth())/2,
                top:Math.max((imagenesH-$contContEdit.outerHeight())/2,20)
            }, 'slow');
            $jcrop_cover=$.Jcrop('#picture');
            $jcrop_cover.setOptions({
                aspectRatio: 1 ,
                onSelect:showPreview,
                onChange:showPreview
            });
            $jcrop_cover.setSelect([0,0,100,100]);
        });
    }

    function setCover(e){
        $(e.target).fadeTo('fast', 0.3);
        var id=$(e.target).parents('.icons').attr('rel');
        $.post(urls.setCover,{
            photoId:id
        },function(result){
            if(result==1){
                var src=obj.selectedAlbum.getPhoto(id).getThumb(100, 100, 'thumb');
                var $img = $albums.find(selectors.album+'[rel='+obj.selectedAlbum.id+']').find('img');
                $img.attr('src',src);
            }else{
                alert(result);
            }
            $(e.target).fadeTo('fast', 1);
        });
    }

    function preloadImg(image) {
        var img = new Image();
        img.src = image;
    }

    function showCoords(c,w,h){//acá grabar los porcentajes de las coordenadas
        var x1=(c.x/w*100).toString();
        var y1=(c.y/h*100).toString();
        var x2=(c.x2/w*100).toString();
        var y2=(c.y2/h*100).toString();
        $x1.val(x1);
        $y1.val(y1);
        $x2.val(x2);
        $y2.val(y2);
    };

    function showPreview(coords){
        if (parseInt(coords.w) > 0){
            var rx = parseInt($preview.parent().outerWidth()) / coords.w;
            var ry = parseInt($preview.parent().outerHeight()) / coords.h;
            var w=$picture.outerWidth();
            var h=$picture.outerHeight()
            $preview.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }
        showCoords(coords,w,h);
    }

    function inArray(value){
        var i;
        var len=this.length;
        for(i=0; i < len; i++){
            if(this[i] === value)
                return true;
        };
        return false;
    };

}


//CLASE PARA MANEJAR LAS IMAGENES DE LA GALERIA
function Photo(_photo,params,user){
    var obj=this;
    var urls=params.urls;
    var traduction=params.traduction;
    var selectors=params.selectors;
    var photoEditHeight=300;
    var $picture;
    var $preview;
    var $contEdit;
    var $x1;
    var $y1;
    var $x2;
    var $y2;
    var $contContEdit;
    var $jcrop_cover;
    var jcrop_tag;
    var $contPhoto;
    //propidades
    this.debugMode =    (params.debugMode)?true:false;
    this.jq=             null;
    this.preloadImg=     null;
    this.name =          _photo.name;
    this.id=             _photo.id;
    this.title =         _photo.title;
    this.orden=          _photo.orden;
    this.album =         _photo.album;
    this.album_id=       _photo.album_id;
    this.created_at=     _photo.created_at;
    this.updated_at =    _photo.updated_at;
    this.username=       user.username;
    this.x1=             _photo.x1;
    this.x2=             _photo.x2;
    this.y1=             _photo.y1;
    this.y2=             _photo.y2;
    this.w;
    this.h;
    this.offset;
    this.tagging=false;
    this.sendingTag=false;
    this.isMine=         params.userId==params.albumUserId;

    //metodos
    this.init=function(){
        if(obj.isMine){
            obj.edit();
            obj.tituloEditable();
            obj.setCover();
            obj.setProfilePhoto();
            obj.erase();
            obj.tagPhoto();
        }
        var $photo=$('#photo'+obj.id);
        obj.w=$photo.outerWidth();
        obj.h=$photo.outerHeight();
        var $viewer=$('#viewer');
        $viewer.css({
            'width':obj.w
            });
        var wViewer=$viewer.parent().outerWidth();
        var marginL =(wViewer/2-obj.w/2);
        $viewer.css({
            'margin-left':marginL+'px'
            });
        obj.offset=$photo.offset();
        obj.getTags();
    }
    this.erase=function(){
        $('.delete').click(function(e){
            e.preventDefault();
            if(confirm('Are you sure?')){
                $(e.target).fadeTo('fast', 0.3);
                $.post(urls.deletePhoto,{
                    photoId:obj.id
                },function(result){
                    if(result==1){
                        document.location=urls.showAlbum+'?id='+obj.album_id;
                    }else{
                        alert(result);
                    }
                    $(e.target).fadeTo('fast', 1);
                });
            }
        });
    }
    this.setCover=function(){
        $('.setCover').click(function(e){
            e.preventDefault();
            $(e.target).fadeTo('fast', 0.3);
            $.post(urls.setCover,{
                photoId:obj.id
            },function(result){
                if(result==1){
                    var src=obj.getThumb(100, 100, 'thumb');
                    var $img = $(selectors.album+'[rel='+obj.id+']').find('img');
                    $img.attr('src',src);
                }else{
                    alert(result);
                }
                $(e.target).fadeTo('fast', 1);
            });
        });
    }
    this.setProfilePhoto=function(){
        $('.setProfilePhoto').click(function(e){
            e.preventDefault();
            $(e.target).fadeTo('fast', 0.3);
            $.post(urls.setProfilePhoto,{
                photoId:obj.id
            },function(result){
                $(e.target).fadeTo('fast', 1);
            });
        });
    }
    this.tituloEditable=function(){
        $(selectors.title+'[rel='+obj.id+']').editable(urls.editTitlePhoto, {
            indicator : "loading...",
            submitdata : function(value, settings) {
                return {
                    photoId: obj.id
                };
            },
            callback : function(value, settings) {
                console.log(this);
                console.log(value);
                console.log(settings);
            },
            tooltip   : traduction.frase21
        });
    }
    this.edit=function(){
        $('.edit').click(function(event){
            event.preventDefault();
            $('#contContEdit').remove();
            $('body').append(obj.getHtmlEdit());
            $('#titlePicture').editable(urls.editTitlePhoto, {//                    edit TITULOS
                indicator : traduction.frase20,
                tooltip   : traduction.frase21,
                onblur:'submit',
                submitdata : function(value, settings) {
                    //                    var _albumId=$(this).attr('rel');
                    return {
                        photoId: obj.id
                    };
                }
            });
            $picture=$('#picture');//                                                     REDIMENSIONADO DE IMAGENES
            $preview=$('#preview');
            $contEdit=$('#contEdit');
            $x1=$('#x1');
            $y1=$('#y1');
            $x2=$('#x2');
            $y2=$('#y2');
            $('#coorsPhoto').submit(function(){
                $.post(urls.editCoors, {
                    x1:$x1.val(),
                    y1:$y1.val(),
                    x2:$x2.val(),
                    y2:$y2.val(),
                    photoId:obj.id
                },
                function(){
                    $('#contContEdit').slideUp('slow',function(){
                        $(this).remove();
                    });
                });
                $jcrop_cover.destroy();
                return false;
            });
            $('#coorsPhoto').find('#cancel').click(function(){
                $jcrop_cover.destroy();
                $('#contContEdit').slideUp('slow',function(){
                    $(this).remove();
                });
                return true;
            });
            $picture.load(function(){
                $contContEdit=$('#contContEdit');
                var w=$('body').outerWidth();
                var h=$('body').outerHeight();
                var centroX=event.pageX;
                var centroY=event.pageY;
                $contContEdit.css({
                    position:'absolute',
                    left:centroX,
                    top:centroY
                });
                $contContEdit.animate({
                    opacity: 'toggle',
                    height:  'toggle',
                    left:    (w-$contContEdit.outerWidth())/2,
                    top:Math.max((h-$contContEdit.outerHeight())/2,20)
                }, 'slow');
                $jcrop_cover=$.Jcrop('#picture');
                $jcrop_cover.setOptions({
                    aspectRatio: 1 ,
                    onSelect:obj.showPreview,
                    onChange:obj.showPreview
                });
                $jcrop_cover.setSelect([0,0,100,100]);
            });
        });
    }
    this.tagPhoto=function(){
        $('.tagPhoto').click(function(e){
            e.preventDefault();
            //            $('#contEdicion').remove();
            if(!obj.tagging){
                obj.tagging=true;
                $picture=$('#photo'+obj.id);
                jcrop_tag=$.Jcrop('#photo'+obj.id);
                $contPhoto=$('#contPhoto');
                $contPhoto.append(obj.getTagForm());
                $('#contTag').slideDown('slow');
                jcrop_tag.setOptions({
                    onSelect:obj.refreshTagForm
                });
                jcrop_tag.setSelect([0,0,100,100]);
                $x1=$('#x1');
                $y1=$('#y1');
                $x2=$('#x2');
                $y2=$('#y2');
                $('#tagForm').submit(function(e){
                    e.preventDefault();
                    var errors=$('#tagForm').validateTagForm();
                    if(!obj.sendingTag && errors['isValid']){
                        $('#contTag .error').slideUp('slow');
                        $('#contTag .error').html('');
                        obj.sendingTag=true;
                        $.post(urls.tagPhoto, {
                            'tag[x1]':$x1.val(),
                            'tag[y1]':$y1.val(),
                            'tag[x2]':$x2.val(),
                            'tag[y2]':$y2.val(),
                            'tag[photo_id]':obj.id,
                            'tag[name]':$('#tagName').val()
                        },
                        function(result){
                            if(typeof(result)=='object'){
                                $('#tags').append(obj.htmlFootTag(result));
                                $('#viewer').append(obj.createTagsFrame(result));
                                displayTags();
                                refreshDeleteTags();
                                $('#tagForm').resetTagForm();
                            }else{
                                alert(result);
                            }
                            obj.sendingTag=false;
                        });
                    }else{
                        $('#contTag .error').html(getHtmlTagErrors(errors));
                        $('#contTag .error').slideDown('slow');
                    }
                });
                $('#cancel').click(function(){
                    jcrop_tag.destroy();
                    $('#tag').resetTagForm();
                    $('#contTag').slideUp('slow');
                    $('#contTag').remove();
                    obj.tagging=false;
                });
            }
        });
    }

    this.showCoords=function(c,w,h){
        var x1=(c.x/w*100).toString();
        var y1=(c.y/h*100).toString();
        var x2=(c.x2/w*100).toString();
        var y2=(c.y2/h*100).toString();
        $x1.val(x1);
        $y1.val(y1);
        $x2.val(x2);
        $y2.val(y2);
    };
    this.showPreview=function(coords){
        if (parseInt(coords.w) > 0){
            var rx = parseInt($preview.parent().outerWidth()) / coords.w;
            var ry = parseInt($preview.parent().outerHeight()) / coords.h;
            var w=$picture.outerWidth();
            var h=$picture.outerHeight();
            $preview.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }
        obj.showCoords(coords,w,h);
    }
    this.getURL=function(size,relativa){//
        relativa=(relativa)?relativa:false;
        size=size?size:'thumb';
        var url=relativa?'':urls.base;
        url+= 'users/'+this.username+'/photos/'+this.album_id+'/'+size+'/'+this.name;
        return url;
    }
    this.getThumb= function(ancho, alto, size){
            size=size?size:'big';
            ancho=ancho?ancho:'100';
            alto=alto?alto:'100';
            var url=obj.getURL(size,true);
        if(this.x1&&this.x2&&this.y1&&this.y2){
            return urls.thumb+'?src='+url+'&w='+ancho+'&h='+alto+'&x1='+obj.x1+'&x2='+obj.x2+'&y1='+obj.y1+'&y2='+obj.y2;
        }else{
            return urls.thumb+'?src='+url+'&w='+ancho+'&h='+alto;
        }
    }
    this.getHtmlMini=function(){
        var html= '<li rel="'+this.id+'" class="photo ui-state-default">';
        html+=        '<ul class="icons" rel="'+this.id+'">';
        html+=            '<li class="options ui-icon ui-icon-circle-triangle-s" title="Options">';
        html+=              '<ul>';
        if(obj.isMine){
            html+=                  '<li class="delete">'+ traduction.frase22 +'</li>';
            html+=                  '<li class="setCover">'+traduction.frase23+'</li>';
            html+=                  '<li class="setProfilePhoto">'+traduction.frase24+'</li>';
            html+=                  '<li class="edit"><a href="'+urls.editPhoto+'?id='+this.id+'">'+traduction.frase25+'</a></li>';
        }
        html+=                  '<li><a href="'+urls.showPhoto+'?id='+this.id+'">'+traduction.frase26+'</a></li>';
        html+=              '</ul>';
        html+=            '</li>';
        if(obj.isMine){
            html+=            '<li class="handlerMove ui-icon ui-icon-grip-dotted-horizontal" title="move"></li>';
        }
        html+=        '</ul>';
        html+=        '<a href="'+this.getURL('big')+'" title="'+this.title+'" class="galery" rel="gal1">';
        html+=            '<img src="'+this.getThumb(100, 100, 'medium')+'" alt="'+this.title+'" title="'+this.title+'" width="100">';
        html+=        '</a>';
        html+=    '</li>';
        return html;
    }
    this.getHtmlEdit=function(){
        var titulo=(this.title=='')?traduction.frase27:this.title;
        var html= '<div id="contContEdit" style="display:none;">';
        html+=        '<div id="contEdit" rel="'+this.id+'">';
        html+=            '<div>';
        html+=                '<img src="'+this.getURL('big')+'" id="picture" height="'+photoEditHeight+'">';
        html+=            '</div>';
        html+=            '<div>';
        html+=                '<div style="width:180px;height:180px;overflow:hidden;margin: 10px;">';
        html+=                    '<img src="'+this.getURL('big')+'" id="preview" style="border:inset 1px solid;">';
        html+=                '</div>';
        html+=                '<div id="titlePicture" style="width:120px;line-height: 1.2em;width: 180px;padding:5px; font-size:12px">'+titulo+'</div>';
        html+=                   '<form name="coors" id="coorsPhoto">';
        html+=                      '<input type="hidden" id="x1" name="x1" />';
        html+=                      '<input type="hidden" id="y1" name="y1" />';
        html+=                      '<input type="hidden" id="x2" name="x2" />';
        html+=                      '<input type="hidden" id="y2" name="y2" />';
        html+=                      '<input type="submit" value="'+traduction.frase29+'" class="button" />';
        html+=                      '<input type="reset" value="Cancel" id="'+traduction.frase28+'" class="button" />';
        html+=                   '</form>';
        html+=             '</div>';
        html+=             '<div style="clear:both;"></div>';
        html+=         '</div>';
        html+=    '</div>';
        return html;
    }
    this.getTagForm=function(){
        var html= '<div id="contTag" style="display:none;margin:auto;width:60%;">';
        html+=        '<form name="tagForm" id="tagForm">';
        html+=            '<input type="hidden" id="x1" name="x1" class="coors" />';
        html+=            '<input type="hidden" id="y1" name="y1" class="coors" />';
        html+=            '<input type="hidden" id="x2" name="x2" class="coors" />';
        html+=            '<input type="hidden" id="y2" name="y2" class="coors" />';
        html+=            '<input type="hidden" id="photo_id" name="photo_id" />';
        html+=            '<input type="text" id="tagName" name="tagName" />';
        html+=            '<input type="submit" value="'+traduction.frase29+'" class="button"/>';
        html+=            '<input type="reset" value="'+traduction.frase28+'" id="cancel" class="button" />';
        html+=        '</form>';
        html+=        '<div class="error" style="display:none"></div>';
        html+=    '</div>';
        html+=    '<div style="clear:both;"></div>';
        return html;
    }
    this.getId = function(){
        return this.id;
    }
    this.htmlFootTag=function(tag){
        var html=   '<span rel="'+tag.id+'" class="tag">&bull;'+tag.name+'&nbsp;';
        html+=          '<span rel="'+tag.id+'" class="deleteTag">&nbsp;'+traduction.frase30+'</span>';
        html+=      '</span>';
        return html;
    }
    this.refreshTagForm=function(c){
        if(c){
            var $photo=$('#photo'+obj.id);
            var w=$photo.outerWidth();
            var h=$photo.outerHeight();
            var x1=(c.x/w*100).toString();
            var y1=(c.y/h*100).toString();
            var x2=(c.x2/w*100).toString();
            var y2=(c.y2/h*100).toString();
            $x1.val(x1);
            $y1.val(y1);
            $x2.val(x2);
            $y2.val(y2);
        }
    }
    this.getTags=function(){
        var $viewer=$('#viewer');
        $.post(urls.getTags,
        {
            photo_id:obj.id
        },
        function(result){
            if(typeof(result)=='object'){
                obj.tags=result;
                for(var i in result){
                    $viewer.append(obj.createTagsFrame(result[i]));
                }
                displayTags();
                refreshDeleteTags();
            }
        });
    }
    this.createTagsFrame=function(tag){
        var $photo=$('#photo'+obj.id);
        var width=(tag.x2-tag.x1)*obj.w/100;
        var height=(tag.y2-tag.y1)*obj.h/100;
        var left=tag.x1*obj.w/100+obj.offset.left;
        var top=tag.y1*obj.h/100+obj.offset.top;
        var styleFrame='style="width:'+width+'px;height:'+height+'px;left:'+left+'px;top:'+top+'px;filter:alpha(opacity=0);opacity: 0;position:absolute;"';
        var styleTitle='style=";left:'+(left)+'px;top:'+(top+5)+'px;filter:alpha(opacity=0);opacity: 0;position:absolute;""';
        var html='<div class="tagTitle" '+styleTitle+' rel="'+tag.id+'">'+tag.name+'</div><div class="tagFrame" '+styleFrame+' rel="'+tag.id+'"></div>';
        return html
    }
    function displayTags(){
        $('.tag').hover(
            function(e){
                var id=$(this).attr('rel');
                $('.tagFrame[rel='+id+']').fadeTo('fast',.2);
            },
            function(e){
                var id=$(this).attr('rel');
                $('.tagFrame[rel='+id+']').fadeTo('fast',0);
            });
        $('.tagFrame').hover(
            function(e){
                var id=$(this).attr('rel');
                $('.tagTitle[rel='+id+']').fadeTo('fast',1);
            },
            function(e){
                var id=$(this).attr('rel');
                $('.tagTitle[rel='+id+']').fadeTo('fast',0);
            });

    }
    function removeTags(id){
        $('.tag[rel='+id+']').remove();
        $('.tagFrame[rel='+id+']').remove();
        $('.tagFrame[rel='+id+']').remove();
    }
    function refreshDeleteTags(){
        var $deleteTag = $('.deleteTag');
        $deleteTag.unbind('click');
        $deleteTag.click(function(e){
            if(confirm('Are you sure?')){
                var id=$(e.target).attr('rel');
                $.post(urls.deleteTag,{
                    tagId:id
                },function(result){
                    if(result=='1'){
                        removeTags(id);
                    }else{
                        alert(result);
                    }
                });
            }
        });
    }
    function getHtmlTagErrors(errors){
        var html=traduction.frase31+'<br />';
        html+=(errors['coors'])?errors['coors']+'<br />':'';
        html+=(errors['name'])?errors['name']:'';
        return html;
    }
    jQuery.fn.extend({
        resetTagForm : function () {
            $(this).each (function() {
                $(this).find('input[type=hidden],input[type=text]').each (function() {
                    $(this).val('');
                });
            });
        },
        validateTagForm : function(){
            var messages=[];
            messages['isValid']=true;

            $(this).find('.coors').each (function() {
                var value=$(this).val();
                if(value==''){
                    messages['coors']=traduction.frase32;
                    messages['isValid']=false;
                }
            });
            $(this).find('#tagName').each (function() {
                var value=$(this).val();
                if(value==''){
                    messages['name']=traduction.frase33;
                    messages['isValid']=false;
                }
            });
            return messages;
        }
    });
}


//CLASE PARA MANEJAR LOS ALBUMS DE LA GALERIA

function Album(album,params){
    var obj=            this;
    var urls=           params.urls;
    var traduction=     params.traduction;
    //propidades
    this.cover;
    this.debugMode =      (params.debugMode)?true:false;
    this.jq=               null;
    this.name =            album.name;
    this.id=               album.id;
    this.ord=              album.ord;
    this.cover_id=         album.cover_id;
    this.created_at=       album.created_at;
    this.updated_at =      album.updated_at;
    this.username=         album.User.username;
    this.lastPhoto=        album.lastPhoto;
    this.user_id=          album.User.id;
    this.photos=           asignPhotos(album.Photos,params,album.User);
    this.isMine=           this.user_id==params.userId;
    this.profileAlbumName= params.profileAlbumName;
    this.isProfileAlbum=   params.profileAlbumName == album.name;


    //metodos
    //this.init=function(){}

    this.getUrlCover=function(){
        if(obj.cover){
            return obj.cover.getThumb(100,100,'thumb');
        }else{
            return urls.thumb;
        }
    }
    this.getHtmlMini=function(){
        var html= '<li class="album  ui-state-default" rel="'+this.id+'">';
        html+=        '<ul class="icons" rel="'+this.id+'">';
        html+=            '<li class="options ui-icon ui-icon-circle-triangle-s" title="Options">';
        html+=              '<ul>';

        if(obj.isMine){
            html+=                  '<li class="delete">'+traduction.frase22+'</li>';
        }
        html+=                  '<li class="show"><a href="'+urls.showAlbum+'?id='+this.id+'">'+traduction.frase26+'</a></li>';
        html+=              '</ul>';
        html+=            '</li>';

        if(obj.isMine){
            html+=            '<li class="handlerMove ui-icon ui-icon-grip-dotted-horizontal" title="move"></li>';
        }
        html+=        '</ul>';
        html+=        '<span class="cover"><a href="'+urls.showAlbum+'/id/'+this.id+'"><img src="'+obj.getUrlCover()+'" alt="'+this.name+'" title="'+this.name+'" width="100"></a></span>';
        html+=        '<span class="'+(this.isProfileAlbum?'profileTitle':'title')+'" rel="'+this.id+'">'+this.name+'</span>';
        html+=     '</li>';
        return html;
    }
    this.getDefaultKey = function(){
        for (var i in obj.photos){
            return i;
        }
    }
    this.getPhoto=function(id){
        for (var i in obj.photos){
            if(obj.photos[i].id==id){
                return obj.photos[i];
            }
        }
        return false;
    }
    this.cover= setCover();
    function asignPhotos(photos,params,user){
        if(obj.debugMode)console.info(traduction.frase34+obj.name);
        var photosArray=[];
        if(photos){
            for (var i in photos){
                photosArray[i] = new Photo(photos[i],params,user);
                if(obj.debugMode)console.info(' -'+photos[i].name);
            }
        }
        return photosArray;
    }
    function setCover(){
        var photo=obj.getPhoto(obj.cover_id)?obj.getPhoto(obj.cover_id):getDefaultPhoto();
        if(obj.debugMode)console.info(traduction.frase35+photo.id);
        return photo;
    }
    function getDefaultPhoto(){
        for (var i in obj.photos){
            return obj.photos[i];
        }
    }
}


