function GMapDriver(mapa){
    var obj=this;
    this.urls={};
    if (GBrowserIsCompatible()) {
        this.geocoder = new GClientGeocoder();
        this.map = new GMap2(document.getElementById(mapa));
        this.map.addControl(new GSmallMapControl());
        this.map.addControl(new GMapTypeControl());
        this.map.setCenter(new GLatLng(40.229218,-4.240723), 5);
        var boxStyleOpts = {
            opacity: .2,
            border: "2px solid red"
        }
        var otherOpts = {
            buttonHTML: '<span style="border=1px solid gray;">Search</span>',
            buttonZoomingHTML: '<span style="border=1px solid blue;">Search</span>'
        };
        var callbacks = {
            dragend: function(nw,ne,se,sw,nwpx,nepx,sepx,swpx){
                $.post(obj.urls.searchNear,{
                    latMin:nw.lat(),
                    lngMin:nw.lng(),
                    latMax:se.lat(),
                    lngMax:se.lng(),
                    'params[user_id]':obj.filterParams['user_id']
                } ,
                function(data) {
                    showEvents(data);
                    obj.loadMap(data);
                });
            }
        };

        this.map.addControl(new DragZoomControl(boxStyleOpts, otherOpts, callbacks));
    }
            
    this.getEvents = function(options){
        $.post(options.url, options.data,
            function(result){
                if(typeof(result)=='object'){
                    obj.loadMap(result);
                }
            });
    }

    this.loadMap = function (objs){
        var bounds = new GLatLngBounds();
        var $descriptionContainer=$('#'+obj.descriptionContainer);
        obj.map.clearOverlays();
        $.each(objs, function(){
            var point = new GLatLng(parseFloat(this.latitude),parseFloat(this.longitude));
            var marker = obj.createMarker(point, this, $descriptionContainer);
            obj.map.addOverlay(marker);
            bounds.extend(point);
            if(objs.length==1){
                GEvent.trigger(marker, 'click');
            }
            $('.event .marker[rel='+this.id+']').click(function(){
                GEvent.trigger(marker, 'click');
            });
        });
    }

    this.createMarker = function(point, nodo, $descriptionContainer) {
        var marker = new GMarker(point);
        var html=getHtmlMarker(nodo);

        GEvent.addListener(marker, 'click', function() {
            obj.actualEvent=nodo.id;
            marker.openInfoWindowHtml(html);
            $descriptionContainer.html(html+'<p>'+nodo.description+'</p>');
        });
        GEvent.addListener(marker, 'mouseover', function() {
            obj.actualEvent=nodo.id;
            marker.openInfoWindowHtml(html);
            $descriptionContainer.html(html+'<p>'+nodo.description+'</p>');
        });
        return marker;
    }

    function getHtmlMarker(nodo){
        var html =  '<div class="marker" rel="'+nodo.id+'">';
        html+=          '<div><strong><a href="/event/'+nodo.id+'">'+ nodo.name+'</a></strong></div>';
        html+=          '<div class="content">';
        html+=(nodo.image)?'<div class="imageEvent"><img src="'+base_url+'users/'+nodo.User.username+'/eventImages/thumb/'+ nodo.image+'" /></div>':'';
        html+=              '<div class="infoEvent"'+((nodo.image)?'':'style="width: auto;margin-left: inherit;"')+'>';
        html+=                  '<strong>Fecha: </strong>'+  formatDate(nodo.date)+'<br/>';
        html+=                  '<strong>Hora: </strong>'+ nodo.hour+'<br/>';
        html+=                  '<strong>Direcci&oacute;n: </strong>'+ nodo.address+'<br/>';
        html+=              '</div>';
        html+=          '</div>';
        html+=      '</div>';
        return html;
    }
            
    function showEvents(events){
        var $eventsContainer=$('.eventsContainer');
        $eventsContainer.html('');
        $.each(events, function(){
            $eventsContainer.append('<div class="event">'+getHtmlMarker(this)+'</div>');
        });
    }
    function formatDate(date){
        var fechaArr=date.split('-');
        var fecha = new Date(fechaArr[0],fechaArr[1],fechaArr[2]);
        var fechaStr=fecha.toLocaleDateString().split(', ');
        return fechaStr[1];
    }
}


