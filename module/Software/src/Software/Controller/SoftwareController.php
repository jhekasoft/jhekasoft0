<?php

namespace Software\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SoftwareController extends AbstractActionController
{
    protected $itemTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'items' => $this->getItemTable()->fetchAll(),
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
        $item = $this->getItemTable()->getItem($id);

        return array(
            'id' => $id,
            'item' => $item,
        );
    }
    
    public function getItemTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Software\Model\SoftwareTable');
        }
        return $this->itemTable;
    }
}
