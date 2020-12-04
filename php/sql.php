<?php
    // SQL
    /*
    $result = mysqli_query($link, "SELECT * FROM `hospitals`");
    $items = [];
    while($i = mysqli_fetch_assoc($result)){
        array_push($items, $i);
    }*/


    //Date
    $monthsNames = [
        'January' => "Январь",
        'February' => "Февраль",
        'March' => "Март",
        'April' => "Апрель",
        'May' => "Май",
        'June' => "Июнь",
        'Jule' => "Июль",
        'August' => "Август",
        'September' => "Сентябрь",
        'October' => "Октябрь",
        'November' => "Ноябрь",
        'December' => "Декабрь",
    ];

    //Date
    $month = date('F', mktime(0, 0, 0, date("m"),   date("d"),   date("Y")));  
    $nextMonth  = date('F', mktime(0, 0, 0, date("m")+1,   date("d"),   date("Y")));
    $nextnextMonth =  date('F', mktime(0, 0, 0, date("m")+2,   date("d"),   date("Y")));


    function draw_calendar($month, $year, $action = 'none') {
        $calendar = '<table class="b-calendar__tb">';
        
        // вывод дней недели
        $headings = array('пн','вт','ср','чт','пт','сб','вс');
        $calendar.= '<tr class="b-calendar__row">';
        for($head_day = 0; $head_day <= 6; $head_day++) {
            $calendar.= '<th class="b-calendar__head';
            // выделяем выходные дни
            if ($head_day != 0) {
                if (($head_day % 5 == 0) || ($head_day % 6 == 0)) {
                    $calendar .= ' b-calendar__weekend';
                }
            }
            $calendar .= '">';
            $calendar.= '<div class="b-calendar__number">'.$headings[$head_day].'</div>';
            $calendar.= '</th>';
        }
        $calendar.= '</tr>';

        // выставляем начало недели на понедельник
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $running_day = $running_day - 1;
        if ($running_day == -1) {
            $running_day = 6;
        }
        
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $day_counter = 0;
        $days_in_this_week = 1;
        $dates_array = array();
        
        // первая строка календаря
        $calendar.= '<tr class="b-calendar__row ">';
        
        // вывод пустых ячеек
        for ($x = 0; $x < $running_day; $x++) {
            $calendar.= '<td class="b-calendar__np"></td>';
            $days_in_this_week++;
        }
        
        // дошли до чисел, будем их писать в первую строку
        for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
            $calendar.= '<td class="b-calendar__day';

            // выделяем выходные дни
            if ($running_day != 0) {
                if (($running_day % 5 == 0) || ($running_day % 6 == 0)) {
                    $calendar .= ' b-calendar__weekend weeknd';
                }
            }
            $calendar .= '">';

            // пишем номер в ячейку
            $calendar.= '<div class="b-calendar__number">'.$list_day.'</div>';
            $calendar.= '</td>';

            // дошли до последнего дня недели
            if ($running_day == 6) {
                // закрываем строку
                $calendar.= '</tr>';
                // если день не последний в месяце, начинаем следующую строку
                if (($day_counter + 1) != $days_in_month) {
                    $calendar.= '<tr class="b-calendar__row">';
                }
                // сбрасываем счетчики 
                $running_day = -1;
                $days_in_this_week = 0;
            }

            $days_in_this_week++; 
            $running_day++; 
            $day_counter++;
        }

        // выводим пустые ячейки в конце последней недели
        if ($days_in_this_week < 8) {
            for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                $calendar.= '<td class="b-calendar__np"> </td>';
            }
        }
        $calendar.= '</tr>';
        $calendar.= '</table>';

        return $calendar;
    }
?>