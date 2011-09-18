<?php use_helper('Date') ?>
<script src="<?php echo sfConfig::get('app_gmaps_js')?>" type="text/javascript"></script> 
<script>
    $(document).ready(function($) {
        <?php if ($sf_user->getGuardUser()->getCountry() == '' || $sf_user->getGuardUser()->getCity() == '') { ?>
        var geocoder;   
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            $('#nosoup').text("Ups!! No hay Geolocalizaci\u00F3n para ti, intenta con un mejor navegador");
        }
        <?php } ?>  
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            geocoder = new GClientGeocoder();
            geocoder.getLocations(new GLatLng(lat,lng), showAddress);
        }
                                
                             
        function showAddress(response) {
            if (!response || response.Status.code != 200) {
                alert("Status Code:" + response.Status.code);
            } else {
                var place = response.Placemark[0];
                var country = place.AddressDetails.Country.CountryName;
                var city = place.AddressDetails.Country.AdministrativeArea.SubAdministrativeArea.SubAdministrativeAreaName;
                var cp = place.AddressDetails.Country.AdministrativeArea.SubAdministrativeArea.Locality.PostalCode.PostalCodeNumber;
                $.get(base_url+"location/editCountry?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+country, function(){});
                $.get(base_url+"location/editCity?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+city, function(){});
                $.get(base_url+"location/editCp?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+cp, function(){});
                $.get(base_url+"location/insertLocation?location="+city+","+country, function(info){
                   showLast(info);
                });
                $('.country').text(country);  
                $('#show_position').removeClass('location');
                $('#show_position').addClass('disable-location');
                $('.city').text(city);
                $('#update').removeClass('update');
                $('#update').addClass('disable-update');
            }
        }
        
        $.get(base_url+"home/listAjaxHome", function(info){
            $('#loading-list').hide();
            $('.pubs-list').show('slow').html(info);
        });
    });  
    var follow_user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
    var follow_follow_id = '<?php echo $datos->getId() ?>';
</script>
<div id="pubsContainer">
    <div class="main-content">
        <div class="pubs-header">
            <div class="pubs-left">
                <?php if ($sf_user->getGuardUser()->getUsername() != $datos->getUsername()) { ?>
                    <?php echo image_tag($datos->getImage(), 'width=150'); ?>
                <?php } else { ?>
                    <?php if (in_array('photo', sfConfig::get('sf_enabled_modules', array()))) { ?>
                        <?php include_partial('photo/profilePhoto'); ?>
                    <?php } else { ?>
                        <?php echo image_tag($datos->getImage(), 'width=150'); ?>
                    <?php } ?>
                <?php } ?>
                <?php include_partial('left', array('datos' => $datos)); ?>
            </div>
            <div class="pubs-center">
                <h1> <?php echo $datos->getUsername() ?>  <span id="loading"><?php echo image_tag(sfConfig::get('app_base_url') . '/PubsPlugin/images/loading.gif') ?></span></h1>
                
                <?php include_partial('pubs/publicator', array('datos' => $datos)); ?>
                <div class="pubs-list">
                    <span id="loading-list"><?php echo image_tag(sfConfig::get('app_base_url') . 'PubsPlugin/images/loading.gif') ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="pubs-right">
        <div class="box-container" style="clear: both">

            <?php if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) { ?>
                <div class="header">
                    <h1><?php echo $sf_request->getParameter('user') ?> Follows </h1>
                </div>
                <div style="overflow: hidden;float: auto">
                    <?php include_component('follow', 'followHomeComponent', array('datos' => $datos)) ?>
                </div>
            <?php } ?>
        </div>
        
        <div class="box-container">
            <?php if (in_array('event', sfConfig::get('sf_enabled_modules', array()))) { ?>
                <div class="header">
                    <h1><?php echo __('All Events', null, 'pubs') ?></h1>
                </div>
                <div id="calendarContainer">
                    <?php include_component('event', 'calendar'); // este componente debe estar siempre incluido en un contenedor ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
