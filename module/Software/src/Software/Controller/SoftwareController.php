<?php

namespace Software\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SoftwareController extends AbstractActionController
{
    protected $softwareTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'softwares' => $this->getSoftwareTable()->fetchAll(),
        ));
    }

    public function showAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('software', array(
                'action' => 'add'
            ));
        }
        $software = $this->getSoftwareTable()->getSoftware($id);

        return array(
            'id' => $id,
            'software' => $software,
        );
    }
    
    public function getSoftwareTable()
    {
        if (!$this->softwareTable) {
            $sm = $this->getServiceLocator();
            $this->softwareTable = $sm->get('Software\Model\SoftwareTable');
        }
        return $this->softwareTable;
    }
}
