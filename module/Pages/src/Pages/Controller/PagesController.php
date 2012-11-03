<?php

namespace Pages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Pages\Module\Pages;
use Pages\Form\PagesForm;

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

    public function editAction()
    {
        if (1) {
            throw new \Exception("Not found.");
        }
        
        $name = (string) $this->params()->fromRoute('name', null);
//        if (!$name) {
//            return $this->redirect()->toRoute('pages', array(
//                'action' => 'add'
//            ));
//        }
        $item = $this->getTable()->getItem($name, array(
            'field' => 'name',
        ));
        
        if (!$item) {
            throw new \Exception("Could not find row $name");
        }
        
        $form  = new PagesForm();
        $form->bind($item);
//        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($item->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $this->getTable()->saveItem($data);

                // Redirect to list of albums
                return $this->redirect()->toRoute('pages/show', array('name' => $data->name));
            }
        }

        return array(
            'id' => $item->id,
            'item' => $item,
            'form' => $form,
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
