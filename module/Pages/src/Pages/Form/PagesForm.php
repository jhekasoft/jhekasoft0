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
        $name->setAttribute('placeholder', 'test-name');

        // Заголовок
        $title = new Element\Text('title');
        $title->setLabel('Заголовок');

        // Текст
        $text = new Element\Textarea('text');
        $text->setLabel('Текст');
        $text->setAttributes(array(
            'id' => 'text',
            'cols' => '80',
            'rows' => '20',
        ));

        // Meta keywords
        $meta_keywords = new Element\Text('meta_keywords');
        $meta_keywords->setLabel('Ключевые слова');

        // Показывать share
        $show_share = new Element\Checkbox('show_share');
        $show_share->setCheckedValue('yes');
        $show_share->setUncheckedValue('no');
        $show_share->setLabel('Показывать share');

        // Показывать комментарии
        $show_comments = new Element\Checkbox('show_comments');
        $show_comments->setCheckedValue('yes');
        $show_comments->setUncheckedValue('no');
        $show_comments->setLabel('Показывать комментарии');

        // Submit
        $submit = new Element\Submit('submit');
        $submit->setValue('Сохранить');

        $this->add($id);
        $this->add($name);
        $this->add($title);
        $this->add($text);
        $this->add($meta_keywords);
        $this->add($show_share);
        $this->add($show_comments);
        $this->add($submit);
    }

}
