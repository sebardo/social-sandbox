<?php

class Calendar {

    protected $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    protected $weekDays = array('L', 'M', 'M', 'J', 'V', 'S', 'D');
    protected $date;
    protected $day = 1;
    protected $month;
    protected $year;
    protected $days = array();
    protected $events = array();

    ///protected $actualDay = 1; //propiedad auxiliar para llevar la cuenta de dias al dibujar el calendario

    public function __construct($date=false, $events=null) {
        $this->date = $date ? $date : time();
        $this->month = date('m', $this->date);
        $this->year = date('Y', $this->date);
        $this->loadDays();
    }

    public function loadDays() {
        for ($i = 1; $i <= $this->countMonthDays(); $i++) {
            $day = $i < 10 ? '0' . $i : $i;
            $actual = $this->year . '-' . $this->month . '-' . $day;
            $this->days[$i] = new CalendarDay($actual);
            $this->days[$i]->isToday = $actual == date('Y-m-d');
            if (!empty($this->events)) {
                if (array_key_exists($actual, $this->events)) {
                    foreach ($this->events[$actual] as $event) {
                        $this->days[$i]->events[] = $event;
                    }
                }
            }
        }
    }

    public function countMonthDays() {
        return date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
    }

    public function getMonthName($month=null) {
        $month = is_null($month) ? $this->month : $month;
        return $this->months[$month - 1];
    }

    public function getYear() {
        return $this->year;
    }

    public function getWeekNumber() {
        $num = date('w', mktime(0, 0, 0, $this->month, $this->day, $this->year));
        if ($num == 0)
            $num = 6;
        else
            $num--;
        return $num;
    }

    public function getFormatedDate($format='Y-m-d') {
        return date($format, $this->date);
    }

    public function getFirstDayTimestamp() {
        return strtotime($this->year . '-' . $this->month . '-1');
    }

    public function getLastDayTimestamp() {
        return strtotime($this->year . '-' . $this->month . '-' . $this->countMonthDays());
    }

    public function getDays() {
        return $this->days;
    }

    public function setEvents($events) {
        $this->events = $events;
        $this->loadDays();
    }

    public function renderDay($hasContent=true) {
        $td = '<td';
        if (array_key_exists($this->day, $this->days) && $hasContent) {
            $day = $this->days[$this->day];
            $td.=' class="day ';
            if ($day->isToday && $day->hasEvents()) {
                $td.='is-today has-events';
            } elseif ($day->isToday) {
                $td.='is-today';
            } elseif ($day->hasEvents()) {
                $td.='has-events';
            }
            $td.='">' . $day->render() . '</td>';
        } else {
            $td.='></td>';
        }
        return $td;
    }

    public function renderWeekTHRow() {
        $html = '<thead><tr>';
        for ($i = 0; $i < count($this->weekDays); $i++) {
            $html.= '<th width="14%" class="diasemana"><span>' . $this->weekDays[$i] . '</span></th>';
        }
        $html.= '</tr></thead>';
        return $html;
    }

    public function renderWeeks() {
        $actualWeekDay = $this->getWeekNumber(); //Número de día de la semana del primer día del mes
        $cantMonthDays = $this->countMonthDays(); //Cantidad de días del mes
        $html = "<tr>";
        for ($i = 0; $i < 7; $i++) {
            if ($i < $actualWeekDay) {
                $html.= $this->renderDay(false);
            } else {
                $html.= $this->renderDay();
                $this->day++;
            }
        }
        $html.= "</tr>";

        $actualWeekDay = 0;
        while ($this->day <= $cantMonthDays) {
            if ($actualWeekDay == 0)
                $html.= "<tr>";
            $html.= $this->renderDay();
            $this->day++;
            $actualWeekDay++;
            if ($actualWeekDay == 7) {
                $actualWeekDay = 0;
                $html.= "</tr>";
            }
        }
        if ($actualWeekDay != 0) {
            for ($i = $actualWeekDay; $i < 7; $i++) {
                $html.= $this->renderDay(false);
            }
        }

        $html.= "</tr>";

        return $html;
    }

    public function renderCalendar($events=array()) {
        $html = '<table cellspacing="0">';
        $html.= $this->renderWeekTHRow();
        $html.= $this->renderWeeks();
        $html.= "</table>";
        return $html;
    }

    public function getSearchForNextMonth() {
        $nextMonth = strtotime('first day of next month', $this->date);
        return '?month=' . date('m', $nextMonth) . '&year=' . date('Y', $nextMonth);
    }

    public function getSearchForPreviousMonth() {
        $previousMonth = strtotime('first day of previous month', $this->date);
        return '?month=' . date('m', $previousMonth) . '&year=' . date('Y', $previousMonth);
    }

    public function renderHead() {
        $html = '  <table id="calendarHead" cellspacing="0">
                    <tr>
                        <td>';
        $html.= '              <a class="previousMonth" href="' . $this->getSearchForPreviousMonth() . '">
                                <span>&lt;&lt;</span>
                            </a>
                        </td>';
        $html.= '          <td class="actualMonth">' . $this->getMonthName($this->month) . " " . $this->year . '</td>';
        $html.= '          <td>';
        $html.= '              <a class="nextMonth" href="' . $this->getSearchForNextMonth() . '">  
                                <span>&gt;&gt;</span></a>
                        </td>';
        $html.= '       </tr>
                </table>';
        return $html;
    }

    public function renderForm() {
        $form = '<form id="calendarForm" action="#" method="get"><table>';
        $form.='<tr>';
        $form.= '<td><select name=month>';
        for ($i = 0; $i < count($this->months); $i++) {
            $form.= '<option value="' . ($i + 1) . '" ' . ($this->month == $i + 1 ? 'selected="selected"' : '') . '>' . $this->months[$i] . '</option>';
        }

        $form.= '</td>';
        $form.= '<td><select name=year>';
        for ($i = date('Y'); $i < date('Y') + 10; $i++) {
            $form.= '<option value="' . $i . '" ' . (($this->year == $i) ? 'selected="selected"' : '') . '>' . $i . '</option>';
        }
        $form.= '</select></td><td><input type="submit" value="Go"></td></tr></table></form>';
        return $form;
    }

}



