<?php

/**
 * link actions.
 *
 * @package    PubsPlugin
 * @subpackage link
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class linkActions extends sfActions {

    public function executeIframeNew(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->duid = $request->getParameter('duid');
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeNew(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->form = new LinkForm();
            $this->form->setDefault('dest_user_id', $request->getParameter('duid'));
            $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LinkForm();
        $link = $request->getParameter('link');
        $this->duid = $link['dest_user_id'];

        $this->processForm($request, $this->form, $this->duid);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($link = Doctrine_Core::getTable('Link')->find(array($request->getParameter('id'))), sprintf('Object link does not exist (%s).', $request->getParameter('id')));
        $this->form = new LinkForm($link);
        $this->form->setDefault('dest_user_id', $request->getParameter('duid'));
        $this->duid = $request->getParameter('duid');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($link = Doctrine_Core::getTable('Link')->find(array($request->getParameter('id'))), sprintf('Object link does not exist (%s).', $request->getParameter('id')));
        $this->form = new LinkForm($link);
        $link = $request->getParameter('link');
        $this->duid = $link['dest_user_id'];

        $this->processForm($request, $this->form, $this->duid);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($link = Doctrine_Core::getTable('Link')->find(array($request->getParameter('id'))), sprintf('Object link does not exist (%s).', $request->getParameter('id')));
        $link->delete();

        $this->redirect('link/new?duid=' . $request->getParameter('duid') . '&delete=1');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $duid) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $link = $form->save();
            //obtengo los datos del enlace con su imagen titulo y descripcion haaa y la url
            $graph = OpenGraph::fetch($link->getUrl());
            $obj = $form->getObject();
            foreach ($graph as $key => $value) {
                switch ($key) {
                    case 'title':
                        $obj->setTitle($value);
                        break;
                    case 'desciption':
                        $obj->setDescription($value);
                        break;
                    case 'site_name':
                        $obj->setSiteName($value);
                        break;
                    case 'image':
                        $obj->setImage($value);
                        break;
                }
            }
            $obj->save();
            //veo si alguno de los campos esta vacio y mando la funcion con curl
            if ($obj->getTitle() == "" || $obj->getDescription() == "") {
                $arr = $this->wget($link->getUrl());

                if ($obj->getTitle() == "") {
                    $obj->setTitle($arr['title']);
                }
                if ($obj->getDescription() == "") {
                    sfContext::getInstance()->getConfiguration()->loadHelpers('Text');
                    $obj->setDescription(truncate_text($arr['description'], 140, '...', true));
                }


                $obj->save();
            }
            $this->redirect('link/edit?id=' . $link->getId() . '&duid=' . $duid);
        }
    }

    public function executeIframeExpand(sfWebRequest $request) {
        
    }

    public function executeEditTitle(sfWebRequest $request) {
        $titulo = $request->getParameter('value');
        $id = $request->getParameter('id');
        $link = Doctrine::getTable('Link')->find($id);
        if ($this->getUser()->isAuthenticated() && $link->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $link->setTitle($titulo);
            $link->save();
        }
        return $this->renderText($link->getTitle());
    }
    
    public function executeEditDesc(sfWebRequest $request) {
        $desc = $request->getParameter('value');
        $id = $request->getParameter('id');
        $link = Doctrine::getTable('Link')->find($id);
        if ($this->getUser()->isAuthenticated() && $link->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $link->setDescription($desc);
            $link->save();
        }
        return $this->renderText($link->getDescription());
    }

    //FUNCION DE CURL
    protected function wget($url) {
//        $url = $request->getParameter('url');
        //@todo si no existen las curl functions usar fsockopen
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        $data = curl_exec($ch);
        curl_close($ch);

        //@todo corregir acentos sin usar multi byte functions
        $arr = array();
        $arr['url'] = $url;
        //titulo
        preg_match_all('@(<title>(.*)</title>)@i', $data, $a);
        $arr['title'] = htmlentities($a[2][0]);

        //obtengo la imagen del sitio si existe
        preg_match_all('@(link\srel=\"image_src\"\shref=\"(.*)\"[ /]*>)@i', $data, $b);
        $arr['image_src'] = $b[2][0];
        unset($b);

        //traigo los meta
        preg_match_all('@(meta\sname=\"(.*)\"\scontent=\"(.*)\"[ /]*>)@i', $data, $c);
        $meta = $c[2];
        $content = $c[3];
        unset($c);
        while (($unMeta = array_pop($meta))) {
            $arr[strtolower($unMeta)] = array_pop($content);
        }
        while (($unMeta = array_pop($meta))) {
            $arr[strtolower($unMeta)] = array_pop($content);
        }

        //traigo mas meta por si estan al revez
        preg_match_all('@(meta\scontent=\"(.*)\"\sname=\"(.*)\"[ /]*>)@i', $data, $d);
        $meta = $d[3];
        $content = $d[2];
        unset($d);
        while (($unMeta = array_pop($meta))) {
            $arr[strtolower($unMeta)] = array_pop($content);
        }

        //traigo metas de OPEN GRAPH PROTOCOL
        preg_match_all('@(meta\sproperty=\"(.*)\"\scontent=\"(.*)\"[ /]*>)@i', $data, $e);
        $meta = $e[2];
        $content = $e[3];
        unset($d);
        while (($unMeta = array_pop($meta))) {
            $arr[strtolower($unMeta)] = array_pop($content);
        }

        return $arr;
    }

}
