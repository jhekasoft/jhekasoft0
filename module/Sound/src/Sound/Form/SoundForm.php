<?php

namespace Sound\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class SoundForm extends Form
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
        $name->setAttribute('placeholder', 'test-name');

        // Автор
        $author = new Element\Text('author');
        $author->setLabel('Автор');

        // Заголовок
        $title = new Element\Text('title');
        $title->setLabel('Заголовок');

        // Текст песни
        $lyrics = new Element\Textarea('lyrics');
        $lyrics->setLabel('Текст песни');
        $lyrics->setAttributes(array(
            'id' => 'text',
            'cols' => '80',
            'rows' => '20',
        ));

        // Файл
        $file = new Element\Text('file');
        $file->setLabel('Файл');
        $file->setAttribute('placeholder', 'bilet33/about_pottering.mp3');

        // Файл 2
        $file2 = new Element\Text('file2');
        $file2->setLabel('Файл 2');
        $file2->setAttribute('placeholder', 'bilet33/about_pottering.ogg');

        // Submit
        $submit = new Element\Submit('submit');
        $submit->setValue('Сохранить');

        $this->add($id);
        $this->add($name);
        $this->add($author);
        $this->add($title);
        $this->add($lyrics);
        $this->add($file);
        $this->add($file2);
        $this->add($submit);
    }

}
