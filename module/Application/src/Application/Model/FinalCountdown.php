<?php

namespace Application\Model;

use DateTime;

class FinalCountdown
{
    public $days = 0;
    public $hours = 0;
    public $minutes = 0;
    public $seconds = 0;
    public $nowDatetimet;
    public $endDatetimet;

    public function __construct($endDatetime)
    {
        $this->nowDatetime = new DateTime('now');
        $this->endDatetime = $endDatetime;
        
        if(strtotime($this->endDatetime->format('Y-m-d H:i:s')) > strtotime($this->nowDatetime->format('Y-m-d H:i:s'))) {
            $diffTime = strtotime($this->endDatetime->format('Y-m-d H:i:s')) - strtotime($this->nowDatetime->format('Y-m-d H:i:s'));

            // Коэффициенты
            $daysRate = 3600*24;
            $hoursRate = 3600;
            $minutesRate = 60;

            // Оставшееся время
            $this->days = floor($diffTime / $daysRate);
            $this->hours = floor(($diffTime - $this->days * $daysRate) / $hoursRate);
            $this->minutes = floor(($diffTime - $this->hours * $hoursRate - $this->days * $daysRate) / $minutesRate);
            $this->seconds = floor(($diffTime - $this->minutes * $minutesRate - $this->hours * $hoursRate - $this->days * $daysRate));
        }
    }
    
    public function getLeftTime()
    {   
        return array(
            'days' => $this->days,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
        );
    }
}
