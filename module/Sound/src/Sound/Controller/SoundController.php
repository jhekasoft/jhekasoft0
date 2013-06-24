<?php

namespace Sound\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\JhekasoftController;
use Zend\View\Model\ViewModel;
use Sound\Model\Sound;
use Sound\Form\SoundForm;

class SoundController extends JhekasoftController
{
    protected $itemTable;

    public function indexAction()
    {
        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        $page = $this->params()->fromRoute('page', 1);
        $parent = $this->params()->fromRoute('parent', null);

        $paginator = $this->getTable()->getPaginator(array(
            'page' => $page,
            'parent' => $parent,
            //'show' => 'all',
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
            'can_edit' => $this->getAuthService()->hasIdentity(),
        );
    }

    public function editAction()
    {
        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        $name = (string) $this->params()->fromRoute('name', null);
        if (!$name) {
            return $this->redirect()->toRoute('sound/add');
        }
        $item = $this->getTable()->getItem($name, array(
            'field' => 'name',
        ));

        if (!$item) {
            throw new \Exception("Could not find row $name");
        }

        $form  = new SoundForm();
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
                return $this->redirect()->toRoute('sound/show', array('name' => $data->name));
            }
        }

        return array(
            'id' => $item->id,
            'item' => $item,
            'form' => $form,
        );
    }

    public function addAction()
    {
        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        $form  = new SoundForm();
        //$form->bind($item);
        $form->get('submit')->setAttribute('value', 'Добавить');

        $item = $this->getServiceLocator()->get('Sound\Model\Sound');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($item->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $item->exchangeArray($form->getData());
                $item->datetime = date('Y-m-d H:i:s', time());
                $this->getTable()->saveItem($item);

                // Redirect to list of albums
                return $this->redirect()->toRoute('sound/show', array('name' => $item->name));
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function getTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Sound\Model\SoundTable');
        }

        return $this->itemTable;
    }
}
