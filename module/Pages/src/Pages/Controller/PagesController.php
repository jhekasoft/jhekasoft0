<?php

namespace Pages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PagesController extends AbstractActionController
{
    protected $itemTable;
    
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);
        $parent = $this->params()->fromRoute('parent', null);
        
        $paginator = $this->getTable()->getPaginator(array(
            'page' => $page,
            'parent' => $parent
        ));
        
        return new ViewModel(array(
            'paginator' => $paginator,
        ));
    }

    public function showAction()
    {
        $name = (string) $this->params()->fromRoute('name', null);

        $item = $this->getTable()->getItem($name, array(
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
    
    public function getTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Pages\Model\PagesTable');
        }
        return $this->itemTable;
    }
}
