<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Application\Model\FinalCountdown;

class FinalCountdownBlock extends AbstractHelper
{
    public function __invoke($endDatetime)
    {
        $view = $this->getView();
        
        $finalCoundown = new FinalCountdown($endDatetime);
        
        $view->days = $finalCoundown->days;
        $view->hours = $finalCoundown->hours;
        $view->minutes = $finalCoundown->minutes;
        $view->seconds = $finalCoundown->seconds;
        
        return $view->render('helper/final-countdown-block');
    }
}
