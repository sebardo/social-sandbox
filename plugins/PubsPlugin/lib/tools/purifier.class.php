<?php
/**
 * Description of purifier
 *
 * @author jp-morvan
 */
class pubsPurifier extends HTMLPurifier
{
  private $HTML_ALLOWED = array(
    'blockquote',
    'br',
    'strong',
    'div',
  );

  public function __construct()
  {
    $config = HTMLPurifier_Config::createDefault();
    $config->set('HTML.Allowed', $this->getHTMLAllowed());
    parent::__construct($config);
  }

  private function getHTMLAllowed()
  {
    $tags = sfConfig::get('app_purifier_allowed_tags', array());
    if(sfConfig::get('app_purifier_merge', true) === true)
    {
      $tags = array_merge($this->HTML_ALLOWED, $tags);
    }
    return join(',', $tags);
  }
}
?>
