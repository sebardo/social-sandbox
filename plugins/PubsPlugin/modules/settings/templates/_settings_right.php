<?php $action =  $sf_request->getParameterHolder()->get('action');echo $action; ?>

<div class="wrapper">
<section class="content <?php echo $action?>">
<?php
switch ($action) {
    case "index":
      ?>
    <h3 class="sectionHeader">Información básica</h3>
        <form action="">
	  <fieldset class="labelLeft">
            <?php echo $form?>
	  </fieldset>
        </form>
    <?php break;
    case "basicinfo":
     ?>
    <h3 class="sectionHeader">Información básica</h3>
        <form action="">
	  <fieldset class="labelLeft">
            <?php echo $form?>
	  </fieldset>
        </form>
    <?php
        break;
    case "aboutme":
     ?>
    <h3 class="sectionHeader">Sobre mí</h3>
        <form action="">
	  <fieldset class="labelLeft">
            <?php echo $form?>
	  </fieldset>
        </form>
    <?php
        break;
    case "interests":
     ?>
    <h3 class="sectionHeader">Intereses</h3>
        <form action="">
	  <fieldset class="labelLeft">
            <?php echo $form?>
	  </fieldset>
        </form>
    <?php
        break;
     case "notifications":
     ?>
    <h3 class="sectionHeader">Notificaciones</h3>
        <form action="">
	  <fieldset class="labelLeft">
            <?php echo $form?>
	  </fieldset>
        </form>
    <?php
        break;
}
?>
</section></div>