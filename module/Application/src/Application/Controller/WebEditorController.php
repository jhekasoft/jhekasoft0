<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebEditorController extends AbstractActionController
{
    
    public function __construct()
    {
        //parent::__construct();
    }
    
    public function elfinderTinymceAction()
    {
        $this->layout('layout/clean');
        
        if (0) {
            throw new \Exception("Not found.");
        }
        
        return new ViewModel(array(
        ));
    }
    
    public function elfinderCkeditorAction()
    {
        $this->layout('layout/clean');
        
        if (0) {
            throw new \Exception("Not found.");
        }
        
        return new ViewModel(array(
        ));
    }
}
