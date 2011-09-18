<?php

class BaseEventComponents extends sfComponents {

    public function executePubContent() {
        $this->event = Doctrine::getTable('Event')->find($this->pub->getDescription());
    }

    public function executeCalendar() {
        $year=$this->getRequestParameter('year');
        $month=$this->getRequestParameter('month');
        $date=strtotime($year.'-'.$month.'-1');
        $this->calendar = new Calendar($date);
        
//        $this->calendario->setMonths(array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'));
        $this->params = array();//en este array las claves se usarán para filtrar la consulta, por lo que la clave debe ser el nombre de alguna columna de la tabla
        if($this->hasRequestParameter('user')){
            $requestedUser = $this->getRequestParameter('user');
            if (is_numeric($requestedUser)) {
                $eventUser = Doctrine::getTable('sfGuardUser')->find($requestedUser);
            } else {
                $eventUser = Doctrine::getTable('sfGuardUser')->findOneBy('username', $requestedUser,Doctrine::HYDRATE_RECORD);
            }
            $this->params['user_id']=$eventUser->getId();
        }
        if(isset($this->userId)){
            $this->params['user_id']=$this->userId;               //si es seteado el user en el componente tiene prioridad sobre el request
        }
        $this->events = Doctrine::getTable('Event')->searchDateRange(array(
                    'min' => date('Y-m-d', $this->calendar->getFirstDayTimestamp()),
                    'max' => date('Y-m-d', $this->calendar->getLastDayTimestamp())), $this->params);
        $eventsByDate=array();
        foreach($this->events as $event){
            $params=array(
            'object' => $event,
            '%id%' => $event->getId(),
            '%name%' => $event->getName(),
            '%image%' => $event->getImagePath(),
            '%date%' => $event->getDate(),
            '%hour%' => $event->getHour(),
            '%address%' => $event->getAddress(),
            '%url%'=>'/event/show/id/'.$event->getId()
        );
            $eventsByDate[date("Y-m-d", strtotime($event->getDate()))][]=$params;
        }
        $this->calendar->setEvents($eventsByDate);
        $template=' <div class="event">
                        <div class="marker">
                            <div><a href="%url%"><strong>%name%</strong></a></div>
                        </div>
                    </div>';
//        $template=' <div class="event">
//                        <div class="marker" rel="%id%">
//                            <div><strong><a href="%url%">%name%</a></strong></div>
//                            <div class="content">
//                                <div class="imageEvent"><image src="%image%"/></div>
//                                <div class="infoEvent">
//                                    <strong>Fecha: </strong>%date%<br/>
//                                    <strong>Hora: </strong>%hour%<br/>
//                                    <strong>Direcci&oacute;n: </strong>%address%<br/>
//                                </div>
//                            </div>
//                        </div>
//                    </div>';
        CalendarDay::setWithEventsTemplate($template);
//        foreach($this->calendar->getDays() as $day){
//            if($day->hasEvents()){
//                foreach($day->getEvents()as $event){
//                    
//                }
//            }
//        }
        
    }

}