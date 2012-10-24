<?php

namespace Software\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SoftwareController extends AbstractActionController
{
    protected $itemTable;
    
    public function indexAction()
    {
        $type = $this->params()->fromRoute('type', null);
        $platform = $this->params()->fromRoute('platform', null);
        $author = $this->params()->fromRoute('author', null);
        $page = $this->params()->fromRoute('page', 1);
        
        $paginator = $this->getTable()->getPaginator(array(
            'type' => $type,
            'platform' => $platform,
            'author' => $author,
            'page' => $page,
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
            $this->itemTable = $sm->get('Software\Model\SoftwareTable');
        }
        return $this->itemTable;
    }
}
