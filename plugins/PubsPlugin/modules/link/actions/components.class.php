<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class linkComponents extends sfComponents {

    public function executeLink(sfWebRequest $request) {
        if(isset($this->url))
        $this->graph = OpenGraph::fetch($this->url);
        if(isset($this->id))
        $this->link = Doctrine_Core::getTable('Link')->find(array($this->id));
    }

   
   
}

?>