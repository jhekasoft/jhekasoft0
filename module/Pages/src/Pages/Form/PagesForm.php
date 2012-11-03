<?php

namespace Pages\Form;

use Zend\Form\Form;
use Zend\Form\Element;
 
class PagesForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'middle_form');
        
        // id
        $id = new Element\Hidden('id');
        
        // Имя
        $name = new Element\Text('name');
        $name->setLabel('Имя');
	         
        // Заголовок
        $title = new Element\Text('title');
        $title->setLabel('Заголовок');
        
        // Текст
        $text = new Element\Textarea('text');
        $text->setLabel('Текст');
        $text->setAttributes(array(
            'cols' => '80',
            'rows' => '20',
        ));
        
        // Submit
        $submit = new Element\Submit('submit');
        $submit->setValue('Сохранить');
        
        $this->add($id);
        $this->add($name);
        $this->add($title);
        $this->add($text);
        $this->add($submit);
    }
    
}
