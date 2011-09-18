
<script type="text/javascript"> 
    $(document).ready(function()
    {   
        var map = new GMap2(document.getElementById("map_<?php echo $obj->getId() ?>"));
        var geocoder = new GClientGeocoder();
        var address = '<?php echo $obj->getDescription() ?>';

        //function showAddress(address) {
        geocoder.getLatLng(
        address,
        function(point) {
            if (!point) {
                alert(address + " not found");
            } else {
                map.setCenter(point, 5);
                var marker = new GMarker(point);
                map.addOverlay(marker);


            }
        }
    );
    })
  
</script> 

<div >
    &nbsp;<?php echo __('has changed its location to', null, 'pubs') ?> <b><?php echo $obj->getDescription() ?></b>
    <div id="map_<?php echo $obj->getId() ?>" style="width: 200px; height: 150px; border: 1px solid #d2d2d2"></div> 
</div>
