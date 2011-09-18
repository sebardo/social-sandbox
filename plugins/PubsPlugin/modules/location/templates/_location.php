<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/jquery.jeditable.js') ?>
    <script type="text/javascript">
        $(document).ready(function($) {
      
            $('a[rel*=delete]').facebox();  

            $(".country").editable('<?php echo sfConfig::get('app_base_url') ?>location/editCountry', {
                indicator : "Saving...",
                placeholder: "Edit Country",
                onblur    : 'submit',
                submitdata : function(value, settings) {
                       
                    if($(this).debugMode)console.info('Editing... ');
                    return {
                          
                    };
                }
            });
            $(".city").editable('<?php echo sfConfig::get('app_base_url') ?>location/editCity', {
                indicator : "Saving...",
                placeholder: "Edit City",
                onblur    : 'submit',
                submitdata : function(value, settings) {
                       
                    if($(this).debugMode)console.info('Editing... ');
                    return {
                          
                    };
                }
            });
        
        
        });
    

    </script>
    <div class="location_user">
        <span id="show_position" onclick="initialize()" class="<?php if ($sf_user->getGuardUser()->getCountry() != '' || $sf_user->getGuardUser()->getCity() != '') { ?>disable-location<?php } else{ ?>location<?php } ?>" ><?php echo __('Location', null, 'pubs')?></span>
        
        <span id="update" class="<?php if ($sf_user->getGuardUser()->getCountry() != '' || $sf_user->getGuardUser()->getCity() != '') { ?>disable-update<?php }else{ ?>update<?php } ?>">← <?php echo __('Click to update', null, 'pubs')?></span>
        
        <div id="nosoup" style="float:none; color: #882122; font-weight: bold; "></div>
        <div style="margin-top: 7px;">
            <span id="<?php echo $sf_user->getGuardUser()->getId() ?>" class="city" ><?php echo $sf_user->getGuardUser()->getCity() ?></span><span style="float: left">,  </span><span id="<?php echo $sf_user->getGuardUser()->getId() ?>" class="country"><?php echo $sf_user->getGuardUser()->getCountry() ?></span><br>
        </div>
         </div> 
    
    <script type="text/javascript"> 
        var geocoder;            
        function initialize() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                $('#nosoup').text("Ups!! No hay Geolocalizaci\u00F3n para ti, intenta con un mejor navegador");
            }
                                    
        }
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
//                var cp = place.AddressDetails.Country.AdministrativeArea.SubAdministrativeArea.Locality.PostalCode.PostalCodeNumber;
                $.get(base_url+"location/editCountry?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+country, function(){});
                $.get(base_url+"location/editCity?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+city, function(){});
//                $.get(base_url+"location/editCp?id=<?php echo $sf_user->getGuardUser()->getId() ?>&value="+cp, function(){});
                $.get(base_url+"location/insertLocation?location="+city+","+country, function(info){
//                    alert(info)
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
                             
                             
    </script> 