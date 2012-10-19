<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use DateTime;

class FinalCountdown extends AbstractHelper
{
    public function __invoke($endDatetime)
    {
        $view = $this->getView();
        
        $nowDatetime = new DateTime('now');
        
        $diffTime = strtotime($endDatetime->format('Y-m-d H:i:s')) - strtotime($nowDatetime->format('Y-m-d H:i:s'));
        
        // Коэффициенты
        $daysRate = 3600*24;
        $hoursRate = 3600;
        $minutesRate = 60;
        
        // Оставшееся время
        $days = floor($diffTime / $daysRate);
        $hours = floor(($diffTime - $days * $daysRate) / $hoursRate);
        $minutes = floor(($diffTime - $hours * $hoursRate - $days * $daysRate) / $minutesRate);
        $seconds = floor(($diffTime - $minutes * $minutesRate - $hours * $hoursRate - $days * $daysRate));
        
        $view->days = $days;
        $view->hours = $hours;
        $view->minutes = $minutes;
        $view->seconds = $seconds;
        
        return $view->render('helper/final-countdown');
    }
}
