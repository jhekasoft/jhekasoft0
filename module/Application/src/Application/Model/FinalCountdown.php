<?php

namespace Application\Model;

use DateTime;

class FinalCountdown
{
    public $days = 0;
    public $hours = 0;
    public $minutes = 0;
    public $seconds = 0;
    public $daysLabel;
    public $hoursLabel;
    public $minutesLabel;
    public $secondsLabel;
    public $nowDatetime;
    public $endDatetime;
    public $isEnd = false;
    protected $functions;

    public function __construct($endDatetime)
    {
        $this->functions = new Functions();
        
        $this->nowDatetime = new DateTime('now');
        $this->endDatetime = $endDatetime;
        
        if(strtotime($this->endDatetime->format('Y-m-d H:i:s')) > strtotime($this->nowDatetime->format('Y-m-d H:i:s'))) {
            $diffTime = strtotime($this->endDatetime->format('Y-m-d H:i:s')) - strtotime($this->nowDatetime->format('Y-m-d H:i:s'));

            // Коэффициенты
            $daysRate = 3600 * 24;
            $hoursRate = 3600;
            $minutesRate = 60;

            // Оставшееся время
            $this->days = floor($diffTime / $daysRate);
            $this->hours = floor(($diffTime - $this->days * $daysRate) / $hoursRate);
            $this->minutes = floor(($diffTime - $this->hours * $hoursRate - $this->days * $daysRate) / $minutesRate);
            $this->seconds = floor(($diffTime - $this->minutes * $minutesRate - $this->hours * $hoursRate - $this->days * $daysRate));
        } else {
            // Отсчёт завершён
            $this->isEnd = true;
        }
        
        // Склонения числительных
        $this->daysLabel = $this->functions->pluralWord($this->days, array('день', 'дня', 'дней'));
        $this->hoursLabel = $this->functions->pluralWord($this->hours, array('час', 'часа', 'часов'));
        $this->minutesLabel = $this->functions->pluralWord($this->minutes, array('минута', 'минуты', 'минут'));
        $this->secondsLabel = $this->functions->pluralWord($this->seconds, array('секунда', 'секунды', 'секунд'));
    }
    
    public function getLeftTime()
    {   
        return array(
            'days' => $this->days,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
            'daysLabel' => $this->daysLabel,
            'hoursLabel' => $this->hoursLabel,
            'minutesLabel' => $this->minutesLabel,
            'secondsLabel' => $this->secondsLabel,
            'isEnd' => $this->isEnd,
        );
    }
}
