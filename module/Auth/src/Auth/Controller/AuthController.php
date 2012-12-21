<?php

namespace Auth\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\JhekasoftController;
use Zend\View\Model\ViewModel;
use Auth\Model\User;
use Auth\Form\LoginForm;

class AuthController extends JhekasoftController
{

    protected $form;
    protected $storage;

    public function getSessionStorage()
    {
        if (!$this->storage) {
            $this->storage = $this->getServiceLocator()
                ->get('Auth\Model\AuthStorage');
        }

        return $this->storage;
    }

    public function getForm()
    {
        if (!$this->form) {
            //$user = new User();
            $this->form = new LoginForm();
        }

        return $this->form;
    }

    public function loginAction()
    {
        //if already login, redirect to success page 
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('auth/success');
        }

        $form = $this->getForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // check authentication...
                $this->getAuthService()->getAdapter()
                    ->setIdentity($request->getPost('login'))
                    ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
//                foreach ($result->getMessages() as $message) {
//                    // save message temporary into flashmessenger
//                    $this->flashmessenger()->addMessage($message);
//                }

                if ($result->isValid()) {
                    // check if it has rememberMe :
                    if ($request->getPost('remember_me') == 1) {
                        $this->getSessionStorage()
                            ->setRememberMe(1);
                        // set storage again 
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('login'));
                    
                    return $this->redirect()->toRoute('auth/success');
                } else {
                    $form->get('password')->setMessages(array('Login or password incorrect'));
                }
            }
        }

        return array(
            'form' => $form,
            //'messages' => $this->flashmessenger()->getCurrentMessages()
        );
    }
    
    public function successAction()
    {
        if (!$this->getServiceLocator()
                ->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('auth/login');
        }

        return new ViewModel();
    }

    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();

        $this->flashmessenger()->addMessage("You've been logged out");
        return $this->redirect()->toRoute('auth/login');
    }

}
