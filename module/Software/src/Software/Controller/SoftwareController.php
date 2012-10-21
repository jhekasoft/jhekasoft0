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
        $name = (string) $this->params()->fromRoute('name', null);

        $item = $this->getItemTable()->getItem($name, array(
            'field' => 'name',
        ));
        
        if (!$item) {
            throw new \Exception("Could not find row $name");
        }

        return array(
            'id' => $item->id,
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
