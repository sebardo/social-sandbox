1 - instalar el plugin PhotoPlugin en plugins
2 - instalar el plugin sfThumbnailPlugin en plugins 
2_1 agregar la clase sfResizedFile.class.php
3 - instalar el plugin sfGuardUserPlugin en plugins
3_1 si se van a habilitar los comentarios de album y o photos instalar el plugin vjCommentable
4 - habilitar en settings.yml del frontend los modulos photo y album
4_1 si se va a usar el backend habilitar los modulos adminPhoto y adminAlbum en el settings.yml del backend
5 - configurar a tu gusto el app.yml del plugin
5 - hacer doctrine build all
6 - publish assets
7 - copiar el siguiente metodo en  /lib/model/doctrine/sfDoctrineGuardPlugin/sfGuardUser.class.php

public function getImage($h=150, $w=150, $size='thumb') {
    $link = sfConfig::get('app_base_url') . '/WallPlugin/images/default_avatar.png';
    if ($this->hasRelation('ProfilePhoto')) {
        $image = $this->getProfilePhoto()->getPhoto();
        if (!$image->isNew()) {
            $link = $image->getThumb($h, $w, $size);
        }
    }
    return $link;
}

8 - incluir jQuery en la carpeta js de tu proyecto y en el view.yml 