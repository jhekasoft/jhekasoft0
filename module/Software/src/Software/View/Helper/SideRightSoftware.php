<?php

namespace Software\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Software\Form\FilterForm;

class SideRIghtSoftware extends AbstractHelper
{
    public function __invoke($data = array())
    {
        $view = $this->getView();
        
        $form  = new FilterForm();
        
        $form->setData($data);
        
        $view->form = $form;
        
        //$view->test = 'dd1';
        
        return $view->render('helper/side-right-software');
    }
}
