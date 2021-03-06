<?php
// auto-generated by sfViewConfigHandler
// date: 2011/09/18 18:56:44
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'indexSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'showSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'shareSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'indexSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/PubsPlugin/css/main.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/nyroModal.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/js/jqueryui/css/theme/jquery-ui-1.8.9.custom.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/jquery.Jcrop.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/galery.css', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/jquery-1.4.2.js', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/livevalidation_standalone.compressed.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jquery.Jcrop.min.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jquery.nyroModal.custom.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jquery.functions.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jqueryui/js/jquery-ui-1.8.9.custom.min.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jeditable/js/jquery.jeditable.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/galery.js', '', array ());
}
else if ($templateName.$this->viewName == 'showSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/PubsPlugin/css/main.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/galery.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/js/jqueryui/css/theme/jquery-ui-1.8.9.custom.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/jquery.Jcrop.css', '', array ());
  $response->addStylesheet('../PhotoPlugin/css/nyroModal.css', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/jquery-1.4.2.js', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/livevalidation_standalone.compressed.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jquery.Jcrop.min.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/jeditable/js/jquery.jeditable.js', '', array ());
  $response->addJavascript('../PhotoPlugin/js/galery.js', '', array ());
}
else if ($templateName.$this->viewName == 'shareSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == '' ? false : ''.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/PubsPlugin/css/main.css', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/jquery-1.4.2.js', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/livevalidation_standalone.compressed.js', '', array ());
}
else
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/PubsPlugin/css/main.css', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/jquery-1.4.2.js', '', array ());
  $response->addJavascript('/sfDoctrineGuardPlugin/js/livevalidation_standalone.compressed.js', '', array ());
}

