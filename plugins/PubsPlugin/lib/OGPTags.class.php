<?php

class OGPTags {

    private $tags = array();

    public function __construct($object) {
        $this->loadMetas($object);
    }

    public static function getXmlns() {
        return 'xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" ';
    }

    public static function createOGPTag($property, $content) {
        return sprintf('<meta property="og:%s" content="%s" />', $property, $content);
    }

    protected function loadMetas($object) {
        $context = sfContext::getInstance();
        $url = $context->getRequest()->getUri();
        $sitename = sfConfig::get('app_site_name', ((sfConfig::get('sf_environment') == 'dev') ? 'Agrega site_name en config/app.yml' : ''));
        $this->tags[] = self::createOGPTag('title', $object->getTitle());
        $this->tags[] = self::createOGPTag('type', $object->getType());
        $this->tags[] = self::createOGPTag('url', $url);
        $this->tags[] = self::createOGPTag('image', $object->getImage());
        $this->tags[] = self::createOGPTag('description', $object->getDescription());
        $this->tags[] = self::createOGPTag('site', $sitename);
    }
    
    public function getTags(){
        return $this->tags;
    }

}

?>
