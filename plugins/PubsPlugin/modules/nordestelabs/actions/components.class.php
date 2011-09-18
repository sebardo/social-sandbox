<?php

class nordestelabsComponents extends sfComponents {

    
    public function executeContact(sfWebRequest $request) {
         $this->form = new contactForm();
         $this->form->setDefault('dest', 'dsastu@gmail.com');
    }

}

?>