<?php
class sfWidgetFormGMapAddress extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('address.options', array('style' => 'width:400px'));

    $this->setOption('default', array(
      'address' => '',
      'longitude' => '2.294359',
      'latitude' => '48.858205'
    ));

    $this->addOption('div.class', 'sf-gmap-widget');
    $this->addOption('map.height', '300px');
    $this->addOption('map.width', '500px');
    $this->addOption('map.style', "");
    $this->addOption('lookup.name', "Lookup");
    $this->addOption('formRel.name', "event_");

    $this->addOption('template.html', '
      <div id="{div.id}" class="{div.class}">
        {input.search} <input type="submit" value="{input.lookup.name}"  id="{input.lookup.id}" /> <br />
        {input.longitude}
        {input.latitude}
        <div id="{map.id}" style="width:{map.width};height:{map.height};{map.style}"></div>
      </div>
    ');

     $this->addOption('template.javascript', '
      <script type="text/javascript">
        jQuery(window).bind("load", function() {
          new sfGmapWidgetWidget({
            longitude: "{input.longitude.id}",
            latitude: "{input.latitude.id}",
            address: "{input.address.id}",
            relLongitude: "{input.relLongitude.id}",
            relLatitude: "{input.relLatitude.id}",
            relAddress: "{input.relAddress.id}",
            lookup: "{input.lookup.id}",
            map: "{map.id}"
          });
        })
      </script>
    ');
  }

  public function getJavascripts()
  {
    return array(
      '/EventPlugin/js/sf_widget_gmap_address.js'
    );
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    // definir las variables principales de la plantilla
    $template_vars = array(
      '{div.id}'             => $this->generateId($name),
      '{div.class}'          => $this->getOption('div.class'),
      '{map.id}'             => $this->generateId($name.'[map]'),
      '{map.style}'          => $this->getOption('map.style'),
      '{map.height}'         => $this->getOption('map.height'),
      '{map.width}'          => $this->getOption('map.width'),
      '{input.lookup.id}'    => $this->generateId($name.'[lookup]'),
      '{input.lookup.name}'  => $this->getOption('lookup.name'),
      '{input.address.id}'   => $this->generateId($name.'[address]'),
      '{input.latitude.id}'  => $this->generateId($name.'[latitude]'),
      '{input.longitude.id}' => $this->generateId($name.'[longitude]'),
      '{input.relAddress.id}'   => $this->generateId($this->getOption('formRel.name').'[address]'),
      '{input.relLatitude.id}'  => $this->generateId($this->getOption('formRel.name').'[latitude]'),
      '{input.relLongitude.id}' => $this->generateId($this->getOption('formRel.name').'[longitude]'),
    );

    // evitar cualquier error o aviso sobre formatos no válidos de $value
    $value = !is_array($value) ? array() : $value;
    $value['address']   = isset($value['address'])   ? $value['address'] : '';
    $value['longitude'] = isset($value['longitude']) ? $value['longitude'] : '';
    $value['latitude']  = isset($value['latitude'])  ? $value['latitude'] : '';

    // definir el widget de la dirección
    $address = new sfWidgetFormInputText(array(), $this->getOption('address.options'));
    $template_vars['{input.search}'] = $address->render($name.'[address]', $value['address']);

    // definir los campos de longitud y latitud
    $hidden = new sfWidgetFormInputHidden;
    $template_vars['{input.longitude}'] = $hidden->render($name.'[longitude]', $value['longitude']);
    $template_vars['{input.latitude}']  = $hidden->render($name.'[latitude]', $value['latitude']);

    // combinar las plantillas y las variables
    return strtr(
      $this->getOption('template.html').$this->getOption('template.javascript'),
      $template_vars
    );
  }
}