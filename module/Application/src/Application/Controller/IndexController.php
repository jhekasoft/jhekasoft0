<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Model\FinalCountdown;
use DateTime;

class IndexController extends AbstractActionController
{
    // Оставшееся время
    protected $endDatetime;
    protected $itemTable;
    
    public function __construct()
    {
        //parent::__construct();
        $this->endDatetime = new DateTime("2012-10-27 18:00:00");
    }
    
    public function indexAction()
    {
        $finalCoundown = new FinalCountdown($this->endDatetime);
        
        return new ViewModel(array(
            'isCoundownEnd' => $finalCoundown->isEnd,
        ));
    }
    
    public function comingSoonAction()
    {
        $this->layout('layout/clean');
        
        return new ViewModel(array(
            'endDatetime' => $this->endDatetime,
        ));
    }
    
    public function ajaxGetLeftTimeAction() {
        if(!$this->getRequest()->isXmlHttpRequest()) {
            throw new \Exception("Not ajax request");
        }
        
        $finalCoundown = new FinalCountdown($this->endDatetime);
        
        $data = array(
            'leftTime' => $finalCoundown->getLeftTime(),
            'status' => 'ok',
        );
        
        return new JsonModel($data);
    }
    
    public function ajaxGetStartLinkAction() {
        if(!$this->getRequest()->isXmlHttpRequest()) {
            throw new \Exception("Not ajax request");
        }
        
        $data = array(
            'link' => $this->url()->fromRoute('home'),
            'status' => 'ok',
        );
        
        return new JsonModel($data);
    }
    
    public function ajaxSaveFinalCountdownEmailAction() {
        if(!$this->getRequest()->isXmlHttpRequest()) {
            throw new \Exception("Not ajax request");
        }
        
        $finalCountdownEmails = new \Application\Model\FinalCountdownEmails();
        
        $datetime = new DateTime('now');
        $finalCountdownEmails->datetime = $datetime->format('Y-m-d H:i:s');
        $finalCountdownEmails->ip = $this->getRequest()->getServer('REMOTE_ADDR');
        $finalCountdownEmails->serverInfo = serialize($_SERVER);
        $finalCountdownEmails->email = (string) $this->getRequest()->getQuery('email');
        
        $finalCountdownEmailsTable = $this->getTable();
        $finalCountdownEmailsTable->saveItem($finalCountdownEmails);
        
        $data = array(
            'email' => $finalCountdownEmails->email,
            'status' => 'ok',
        );
        
        return new JsonModel($data);
    }
    
    public function getTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Application\Model\FinalCountdownEmailsTable');
        }
        return $this->itemTable;
    }
}
