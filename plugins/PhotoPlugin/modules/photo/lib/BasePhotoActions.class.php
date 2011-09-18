<?php

/**
 * photo actions.
 *
 * @package    
 * @subpackage photo
 * @author     Adrian Baez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BasePhotoActions extends sfActions {

    public function executePrueba(sfWebRequest $request) {
        
    }

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $userId = $request->getParameter('user', $user->getGuardUser()->getId());
            $this->user = Doctrine::getTable('sfGuardUser')->find($userId); //                         usuario que se pasa a los componentes album e photo
            $this->form = new PhotoForm();
        } else {
            return $this->redirect('@homepage');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        if ($this->getUser()->isAuthenticated()) {
            $this->form = new PhotoForm();
            $this->processForm($request, $this->form);
            $noPhoto=sfContext::getInstance()->getI18n()->__('You must select an image', null, 'photo');
            $noCant=sfContext::getInstance()->getI18n()->__("You can't do that", null, 'photo');
            
            return $this->renderText('<div id="noPhoto" class="ui-state-error">'.$noPhoto.'</div>');
        } else {
            return $this->renderText('<div id="noPhoto" class="ui-state-error">'.$noCant.'</div>');
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $values = $request->getParameter($form->getName()); //                               Traigo las variables del formulario
        $albumId = ($values['album_id'] != '') ? $values['album_id'] : false;
        if ($albumId !== false) {//                                                          trae un album así que todo mas que bien
            $form->bind($values, $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $photo = $form->save();
//                echo 'el form es válido y vino con un id de album';
                $this->redirect('photo/previewPhoto?id=' . $photo->getId());
            }
        } else {//                                                                           no trae ningún album , así que se crea uno con la fecha actual como titulo por defecto
            $name = ($request->getParameter('forProfile') == 1) ? Album_photo::getProfileAlbumName() : date('Y/m/d'); //si es para perfil pone el nombre de perfil al album si no la fecha
            $album = Doctrine::getTable('Album_photo')->findByDql('name=? AND user_id =?', array($name, $this->getUser()->getGuardUser()->getId())); //             primero averiguo si ya hay uno creado
            $album = $album[0];
            if (!$album->exists()) {//Si no existe se crea
                $album = new Album_photo();
                $album->name = $name;
                $album->user_id = $this->getUser()->getGuardUser()->getId();
                $album->save();
//                echo 'Se acaba de crear el album '.$name;
            }
            $values['album_id'] = $album->getId(); //  
//                echo 'El id del album es '.$album->getId();
            $form->bind($values, $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $photo = $form->save();
                if ($request->getParameter('forProfile') == 1) {
//                echo 'es una foto de perfil';
                    $profilePhoto = $this->getUser()->getGuardUser()->getProfilePhoto();
                    if ($profilePhoto->isNew()) {
                        $profilePhoto->setUserId($photo->getUser()->getId());
                    }
                    $profilePhoto->setPhotoId($photo->getId());
                    $profilePhoto->save();
                }
//                echo 'acá se debería redirigir';
                $this->redirect('photo/previewPhoto?id=' . $photo->getId());
            }
        }
    }

    public function executeSetProfilePhoto(sfWebRequest $request) {
        $size = $request->getParameter('size', 'thumb');
        $photo = Doctrine::getTable('Photo')->find($request->getParameter('photoId'));
        $this->forward404Unless($photo, 'This photo not exists');
        $photo->setAsProfilePhoto();
        return $this->renderText($photo->getLink($size));
    }

    public function executeShow(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->photo = Doctrine::getTable('photo')->find($request->getParameter('id'));
            $this->forward404Unless($this->photo, 'This photo not exists');
            $this->album = $this->photo->getAlbum();
            $this->user = $this->photo->getUser();
        } else {
            return $this->redirect('@homepage');
        }
    }

    public function executeList(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        $res = array();
        $userId = $request->getParameter('userId');
        $res['albums'] = Doctrine::getTable('Album_photo')->listAlbumsQuery(array('user_id' => $userId))->fetchArray();
        return $this->renderText(json_encode($res));
    }

    public function executeGetPhoto(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        $photoId = $request->getParameter('photoId');
        $photo = Doctrine::getTable('Photo')->getPhotoQuery(array('photo_id' => $photoId))->fetchArray();
        return $this->renderText(json_encode($photo[0]));
    }

    public function executeOrd(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || !$this->getUser()->isAuthenticated());
        $albumId = $request->getParameter('albumId');
        $album = Doctrine::getTable('Album_photo')->find($albumId);
        if ($album->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $album->ordPhotos($request->getParameter('ord'));
            return $this->renderText('ok');
        } else {
            return $this->renderText('You do not have permission');
        }
    }

    public function executeEditTitle(sfWebRequest $request) {
        $title = $request->getParameter('value');
        $photoId = $request->getParameter('photoId');
        $photo = Doctrine::getTable('photo')->find($photoId);
        if ($this->getUser()->isAuthenticated() && $photo->getAlbum()->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $photo->title = $title;
            $photo->save();
        }
        return $this->renderText($photo->getTitle());
    }

    public function executeSetCover(sfWebRequest $request) {
        $photoId = $request->getParameter('photoId');
        $photo = Doctrine::getTable('photo')->find($photoId);
        $album = Doctrine::getTable('Album_photo')->find($photo->getAlbumId());
        if ($this->getUser()->isAuthenticated() && $album->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $album->cover_id = $photoId;
            $album->save();
            return $this->renderText('1');
        } else {
            return $this->renderText('You can\'t do that');
        }
    }

    public function executeEditCoors(sfWebRequest $request) {
        $x1 = $request->getParameter('x1');
        $x2 = $request->getParameter('x2');
        $y1 = $request->getParameter('y1');
        $y2 = $request->getParameter('y2');
        $photoId = $request->getParameter('photoId');
        $photo = Doctrine::getTable('photo')->find($photoId);
        if ($this->getUser()->isAuthenticated() && $photo->getAlbum()->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $photo->x1 = $x1;
            $photo->x2 = $x2;
            $photo->y1 = $y1;
            $photo->y2 = $y2;
            $photo->save();
            return $this->renderText('ok');
        } else {
            $this->forward404('No tienes permiso para modificar esta photo');
        }
    }

    public function executeTagPhoto(sfWebRequest $request) {
        $values = $request->getParameter('tag');
        $tag = new Tags_photo();
        $tag->setName($values['name']);
        $tag->setX1($values['x1']);
        $tag->setX2($values['x2']);
        $tag->setY1($values['y1']);
        $tag->setY2($values['y2']);
        $tag->setPhotoId($values['photo_id']);
        if ($this->getUser()->isAuthenticated() && $tag->getPhoto()->getAlbum()->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $this->getResponse()->setContentType('application/json');
            $tag->save();
            return $this->renderText(json_encode($tag->getData()));
        } else {
            $this->forward404('You have not permission to tag this photo.');
        }
    }

    public function executeGetTags(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        $photoId = $request->getParameter('photo_id');
        $photo = Doctrine::getTable('Photo')->find($photoId);
        $this->forward404Unless($photo);
        $res = $photo->getTags();
        return $this->renderText($res->exportTo('json'));
    }

    public function executeMove(sfWebRequest $request) {
        $photoId = $request->getParameter('photoId', false);
        $albumId = $request->getParameter('albumId', false);
        $this->forward404Unless($photoId && $albumId);
        $photo = Doctrine::getTable('photo')->find($photoId);
        $this->forward404Unless($photo->exists());
        $photoUser = $photo->getUser();
        if ($this->getUser()->isAuthenticated() && $photoUser->getId() == $this->getUser()->getGuardUser()->getId()) {
            if ($photo->getAlbumId() == $albumId) {
                return $this->renderText('This photo is already on this album.');
            } else {
                if ($photo->moveFromTo($photo->getAlbumId(), $albumId)) {
                    $photo->album_id = $albumId;
                    $photo->save();
                    return $this->renderText('1');
                } else {
                    return $this->renderText('A fatal error has occurred');
                }
            }
        }
        return $this->renderText('You do not have permission to edit this photo');
    }
    
    public function executeDeletePreview(sfWebRequest $request) {
        $this->forward404Unless($photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('photoId'))), sprintf('Object audio does not exist (%s).', $request->getParameter('photoId')));
        
        $photoUser = $photo->getUser();
        if ($this->getUser()->isAuthenticated() && $photoUser->getId() == $this->getUser()->getGuardUser()->getId()) {
            $photo->delete();
        }
        
        $this->redirect('photo/share?duid=' . $request->getParameter('duid') . '&delete=1');
    }
    
    public function executeDelete(sfWebRequest $request) {
        $photoId = $request->getParameter('photoId', false);
        $this->forward404Unless($photoId);
        $photo = Doctrine::getTable('photo')->find($photoId);
        $this->forward404Unless($photo->exists());
        $photoUser = $photo->getUser();
        if ($this->getUser()->isAuthenticated() && $photoUser->getId() == $this->getUser()->getGuardUser()->getId()) {
            return $this->renderText($photo->delete());
        }
        return $this->renderText('You can\'t do that');
    }

    public function executeDeleteTag(sfWebRequest $request) {
        $tagId = $request->getParameter('tagId', false);
        $this->forward404Unless($tagId);
        $tag = Doctrine::getTable('Tags_photo')->find($tagId);
        $this->forward404Unless($tag);
        $photoUser = $tag->getPhoto()->getUser();
        if ($this->getUser()->isAuthenticated() && $photoUser->getId() == $this->getUser()->getGuardUser()->getId()) {
            $tag->delete();
            return $this->renderText('1');
        }
        return $this->renderText('You have not permission to delete this tag.');
    }

    public function executePreviewPhoto(sfWebRequest $request) {
        $this->photo = Doctrine::getTable('Photo')->find($request->getParameter('id'));
        $this->forward404Unless($this->photo);

        $this->setLayout(false);
    }

    public function executeThumb(sfWebRequest $request) {
        $src = $request->getGetParameter('src', 'PhotoPlugin/images/album_default.png');
        list($ancho, $alto) = getimagesize($src);
        $an = $request->getGetParameter('w', 100);
        $al = $request->getGetParameter('h', 100);
        $min = min($ancho, $alto);
        $max = max($ancho, $alto);
        $ratio = $min / $max * 100;
        $defaultAncho = $ancho > $alto ? $ratio : 100;
        $defaultAlto = $alto > $ancho ? $ratio : 100;
        $this->getResponse()->setHttpHeader('Content-Type', 'image/jpg', TRUE);
        $this->getResponse()->sendHttpHeaders();
        $img = new imageThumbnail($an, $al);
        $coords['x1'] = $request->getGetParameter('x1', 0) * $ancho / 100;
        $coords['x2'] = $request->getGetParameter('x2', $defaultAncho) * $ancho / 100;
        $coords['y1'] = $request->getGetParameter('y1', 0) * $alto / 100;
        $coords['y2'] = $request->getGetParameter('y2', $defaultAlto) * $alto / 100;
        imagejpeg($img->recorta($src, $coords));
        return sfView::NONE;
    }

    public function executeShare(sfWebRequest $request) {
        $this->setLayout(false);
        $this->isUploaded = false;
        $this->duid = $request->getParameter('duid');
        $this->dest_user_id = $request->getParameter('duid', $this->getUser()->getGuardUser()->getId());
        $form = new PhotoForm();
        if ($request->isMethod('post')) {
            $values = $request->getParameter($form->getName());
            $name = Album_photo::getWallAlbumName();
            $album = Doctrine::getTable('Album_photo')->findByDql('name=? AND user_id =?', array($name, $this->dest_user_id));
            $album = $album[0];
            if (!$album->exists()) {
                $album = new Album_photo();
                $album->name = $name;
                $album->user_id = $this->dest_user_id;
                $album->save();
            }
            $values['album_id'] = $album->getId();
            $form->bind($values, $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $photo = $form->save();
                $this->photo = $photo;
                $this->isUploaded = true;
            }
        }
        $this->form = $form;
    }

//    public function executeLastPubPhoto(sfWebRequest $request) {
//        $user = $this->getUser();
//        if ($user->isAuthenticated()) {
//            $user_sf = $user->getGuardUser()->getId();
//
//            $q = Doctrine_Query::create()
//                    ->from('wall m')
//                    ->where('m.user_id = ?', $user_sf)
//                    ->orderby('m.created_at DESC')
//                    ->limit(1);
//            $this->pub = $q->fetchOne();
//
//            $this->user_pub = $this->getUser()->getGuardUser();
//
//            return $this->renderPartial('photo/lastPubPhoto');
//        }
//    }
//
//    public function executeGetPhotoPub(sfWebRequest $request) {
//        $user = $this->getUser();
//        if ($user->isAuthenticated()) {
//            $q = Doctrine_Query::create()
//                    ->from('photo p')
//                    ->where('p.id = ?', $request->getParameter('id'))
//                    ->limit(1);
//            $this->photo = $q->fetchOne();
//            return $this->renderPartial('photo/getPhotoPub');
//        }
//    }

    public function executePreviewPubliPhoto(sfWebRequest $request) {
        $photo = Doctrine::getTable('Photo')->find($request->getParameter('photo_id'));
        return $this->renderPartial('photo/previewPubliPhoto', array('photo' => $photo));
    }

    public function executePubliPhoto(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->duid = $request->getParameter('duid');
            return $this->renderPartial('photo/publiPhoto', array('duid' => $this->duid));
        }else{
            $this->redirect('unauthorized/index');
        }
    }

}
