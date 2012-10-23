<?php

namespace Software\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SideLeftSoftware extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
        
        //$view->test = 'dd1';
        
        return $view->render('helper/side-left-software');
    }
}
