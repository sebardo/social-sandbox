<?php

class CalendarDay {

    public $format = "Y-m-d";
    public $events = array();
    public $isToday = false;
    protected $date;
    protected $month;
    protected $day;
    protected $year;
    protected static $defaultTemplate = "%day%";
    protected $defaultTemplateParams;
    protected static $withEventsTemplate = '%day%';
    protected $withEventsTemplateParams;
    protected static $renderMultipleEvents=true;

    public function __construct($day) {
        $this->date = strtotime($day);
        $this->day = date('d', $this->date);
        $this->month = date('m', $this->date);
        $this->year = date('Y', $this->date);
        $this->setDefaultTemplateParams(array('%day%' => $this->day));
        $this->setWithEventsTemplateParams(array('%day%' => $this->day));
    }

    public static function setRenderMultipleEvents($multiple) {
        self::$renderMultipleEvents = $multiple;
    }

    public function setDefaultTemplateParams($params) {
        $this->defaultTemplateParams = $params;
    }

    public static function setDefaultTemplate($template) {
        self::$defaultTemplate = $template;
    }

    public function setWithEventsTemplateParams($params) {
        $this->withEventsTemplateParams = $params;
    }

    public static function setWithEventsTemplate($template) {
        self::$withEventsTemplate = $template;
    }

    public function getDate($format=null) {
        $format = is_null($format) ? $this->format : $format;
        return date($format, $this->date);
    }

    public function hasEvents() {
        return !empty($this->events);
    }

    public function render() {
        $content='<div class="calendar-event-container">';
        $content.=strtr(self::$defaultTemplate, $this->defaultTemplateParams);
        if ($this->hasEvents()) {
            if (self::$renderMultipleEvents) {
                foreach ($this->events as $event) {
                    $content.= strtr(self::$withEventsTemplate, $event);
                }
            } else {
                $content.= strtr(self::$withEventsTemplate, $this->withEventsTemplateParams);
            }
        }
        $content.='</div>';
        return $content;
    }

}

?>
