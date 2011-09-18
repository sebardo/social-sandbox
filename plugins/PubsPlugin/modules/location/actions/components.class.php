<?php 

class locationComponents extends sfComponents
{
    public function executeLocationPub(){
        $this->obj = Doctrine::getTable('Location')->find($this->id);
    }
}