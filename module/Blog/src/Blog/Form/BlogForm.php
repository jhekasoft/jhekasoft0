<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BlogForm extends Form
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

        // Дата
        $datetime = new Element\Text('datetime');
        $datetime->setLabel('Дата и время');
        $datetime->setAttribute('placeholder', 'Y-m-d H:i:s (оставить пустым для автоматического заполнения)');

        // Заголовок
        $title = new Element\Text('title');
        $title->setLabel('Заголовок');

        // Текст предпросмотра
        $cut_text = new Element\Textarea('cut_text');
        $cut_text->setLabel('Текст предпросмотра');
        $cut_text->setAttributes(array(
            'id' => 'cut_text',
            'cols' => '80',
            'rows' => '4',
        ));

        // Текст
        $text = new Element\Textarea('text');
        $text->setLabel('Текст');
        $text->setAttributes(array(
            'id' => 'text',
            'cols' => '80',
            'rows' => '20',
        ));

        // Изображение
        $image = new Element\Text('image');
        $image->setLabel('Изображение');

        // Meta keywords
        $meta_keywords = new Element\Text('meta_keywords');
        $meta_keywords->setLabel('Ключевые слова');

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
        $this->add($datetime);
        $this->add($title);
        $this->add($cut_text);
        $this->add($text);
        $this->add($image);
        $this->add($meta_keywords);
        $this->add($show_comments);
        $this->add($submit);
    }

}
