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
        
        $view->leftTime = $finalCoundown->getLeftTime();
        
        return $view->render('helper/final-countdown-block');
    }
}
