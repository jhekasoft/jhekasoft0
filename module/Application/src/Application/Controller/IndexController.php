<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

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
    
    public function __construct()
    {
        $this->endDatetime = new DateTime("2012-10-27 18:00:00");
    }
    
    public function indexAction()
    {
        return new ViewModel();
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
}
