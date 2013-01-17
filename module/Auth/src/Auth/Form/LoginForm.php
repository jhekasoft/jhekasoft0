<?php

namespace Auth\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'middle_form');

        // Login
        $login = new Element\Text('login');
        $login->setLabel('Логин');

        // Password
        $password = new Element\Password('password');
        $password->setLabel('Пароль');

        // Запомнить
        $remember_me = new Element\Checkbox('remember_me');
        $remember_me->setCheckedValue('1');
        $remember_me->setUncheckedValue('0');
        $remember_me->setLabel('Запомнить меня');

        // Submit
        $submit = new Element\Submit('submit');
        $submit->setValue('Войти');

        $this->add($login);
        $this->add($password);
        $this->add($remember_me);
        $this->add($submit);
    }

}
