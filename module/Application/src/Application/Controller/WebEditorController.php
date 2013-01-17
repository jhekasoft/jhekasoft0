<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebEditorController extends AbstractActionController
{
    protected $authservice;

    public function getAuthService()
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()
                ->get('AuthService');
        }

        return $this->authservice;
    }

    public function __construct()
    {
        //parent::__construct();
    }

    public function elfinderTinymceAction()
    {
        $this->layout('layout/clean');

        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        return new ViewModel(array(
        ));
    }

    public function elfinderCkeditorAction()
    {
        $this->layout('layout/clean');

        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        return new ViewModel(array(
        ));
    }
}
