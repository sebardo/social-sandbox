<?php
if($follow->getIsActive() == '2'){
?>
<span style="background-color: #FF0000; padding: 4px; color: #FFF; font-weight: bold;">Peticion en espera</span>
<?php
}elseif($follow->getIsActive() == '1'){
?>
<span style="background-color: #00FF00; padding: 4px; color: #FFF; font-weight: bold;">Activa </span>
<?php
}
?>
