<?php

class Calendar2 {

    protected $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    protected $weekDays = array('L', 'M', 'M', 'J', 'V', 'S', 'D');
    protected $date;
    protected $month;
    protected $day;
    protected $year;
    protected $events = array();

    ///protected $actualDay = 1; //propiedad auxiliar para llevar la cuenta de dias al dibujar el calendario

    public function __construct($date=false) {
        $this->date = $date ? $date : time();
        $this->month = date('m', $this->date);
        $this->day = 1; //date('d', $this->date);
        $this->year = date('Y', $this->date);
    }

    public function countMonthDays() {
        $cant = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
        return $cant;
    }

    public function getWeekNumber() {
        $num = date('w', mktime(0, 0, 0, $this->month, $this->day, $this->year));
        if ($num == 0)
            $num = 6;
        else
            $num--;
        return $num;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function getYear() {
        return $this->year;
    }

    public function getMonthName($month) {
        return $this->months[$month - 1];
    }

    public function getNextMonth() {
        $nextMonth = $this->month + 1;
        if ($nextMonth == 13) {
            $nextMonth = 1;
        }
        return $nextMonth;
    }

    public function getPreviousMonth() {
        $previousMonth = $this->month - 1;
        if ($previousMonth == 0) {
            $previousMonth = 12;
        }
        return $previousMonth;
    }

    public function getFirstDayTimestamp() {
        return strtotime($this->year . '-' . $this->month . '-1');
    }

    public function getLastDayTimestamp() {
        return strtotime($this->year . '-' . $this->month . '-' . $this->countMonthDays());
    }

    public function getFormatedDate($format='Y-m-d') {
        return date($format, $this->date);
    }

    public function getDayTemplateParams(){
        if(empty($this->dayTemplateParams)){
            return array('%attributes%'=>$this->isToday()?'class="today"':'','%content%'=>$this->getDay());
        }
        return $this->dayTemplateParams;
    }
    
    public function setMonths($months) {
        $this->months = $months;
    }

    public function setWeekDays($weekDays) {
        $this->weekDays = $weekDays;
    }

    public function setEvents($events) {
        $this->events = $events;
    }

    public function getEvents() {
        return $this->events;
    }

    public function refreshDate() {
        $this->date = strtotime($this->year . '-' . $this->month . '-' . $this->day);
    }

    public function printWeekTHRow() {
        $html = '<thead><tr>';
        for ($i = 0; $i < count($this->weekDays); $i++) {
            $html.= '<th width="14%" class="diasemana"><span>' . $this->weekDays[$i] . '</span></th>';
        }
        $html.= '</tr></thead>';
        return $html;
    }

    public function printDay($hasContent=true) {
        return strtr($this->dayTemplate,($hasContent? $this->getDayTemplateParams():array('%content%'=>'')));
    }
    
    public function isToday(){
        return date('Y-m-d', $this->getDate()) == date('Y-m-d');
    }
    
    public function dayHasEvents(){
        return array_key_exists($this->getFormatedDate(), $this->events);
    }

    public function printWeeks() {
        $actualWeekDay = $this->getWeekNumber(); //Número de día de la semana del primer día del mes
        $cantMonthDays = $this->countMonthDays(); //Cantidad de días del mes
//        $hasEvents = !empty($this->events);
        $html = "<tr>";
        for ($i = 0; $i < 7; $i++) {
//            $content = $hasEvents && array_key_exists($this->getFormatedDate(), $this->events) ? $this->events[$this->getFormatedDate()] : $this->day;
            if ($i < $actualWeekDay) {
                $html.= $this->printDay(false);
            } else {
                $html.= $this->printDay();
                $this->day++;
                $this->refreshDate();
            }
        }
        $html.= "</tr>";

        $actualWeekDay = 0;
        while ($this->day <= $cantMonthDays) {
//            $content = $hasEvents && array_key_exists($this->getFormatedDate(), $this->events) ? $this->events[$this->getFormatedDate()] : $this->day;
            if ($actualWeekDay == 0)
                $html.= "<tr>";
            $html.= $this->printDay();
            $this->day++;
            $this->refreshDate();
            $actualWeekDay++;
            if ($actualWeekDay == 7) {
                $actualWeekDay = 0;
                $html.= "</tr>";
            }
        }

        for ($i = $actualWeekDay; $i < 7; $i++) {
            $html.= $this->printDay(false);
        }

        $html.= "</tr>";

        return $html;
    }

    public function printCalendar($events=array()) {
        $html = '<table>';
        $html.= $this->printWeekTHRow();
        $html.= $this->printWeeks($events);
        $html.= "</table>";
        return $html;
    }

    public function printCabecera() {
        $html = '  <table>
                    <tr>
                        <td class="messiguiente">';
        $html.= '              <a href="?date=' . strtotime('first day of previous month', $this->date) . '">
                                <span>&lt;&lt;</span>
                            </a>
                        </td>';
        $html.= '          <td class="titmesano">' . $this->getMonthName($this->month) . " " . $this->year . '</td>';
        $html.= '          <td class="mesanterior">';
        $html.= '              <a href="?date=' . strtotime('first day of next month', $this->date) . '">  
                                <span>&gt;&gt;</span></a>
                        </td>';
        $html.= '       </tr>
                </table>';
        return $html;
    }

    public function formularioCalendario() {
        echo '
	<table>
	<tr><form action="" method="POST">';
        echo '<td align="center" valign="top">Mes: <br><select name=nuevo_mes>';
        for ($i = 0; $i < count($this->months); $i++) {
            echo '<option value="' . ($i + 1) . '" ' . ($this->month == $i + 1 ? 'selected="selected"' : '') . '>' . $this->months[$i] . '</option>';
        }

        echo '</td>';
        echo '<td align="center" valign="top">A&ntilde;o: <br><select name=nuevo_ano>';
        for ($i = $this->year; $i < $this->year + 10; $i++) {
            echo '<option value="' . $i . '" ' . (($this->year == $i) ? 'selected="selected"' : '') . '>' . $i . '</option>';
        }
        echo '</select></td></tr><tr><td colspan="2" align="center"><input type="Submit" value="[ IR A ESE MES ]"></td></tr></table><br><br></form>';
    }

}

?>
