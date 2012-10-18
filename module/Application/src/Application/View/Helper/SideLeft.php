<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SideLeft extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
        
        $view->test = 'dd';
        
        return $view->render('helper/side-left');
    }
}
