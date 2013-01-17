<?php

namespace Software\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class FilterForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'filter_form');

        // Тип
        $type = new Element\Select('filter_type');
        //$type->setLabel('Тип');
        $type->setEmptyOption('');
        $type->setValueOptions(array(
            'software' => 'Приложение',
            'game' => 'Игра',
        ));
        $type->setAttributes(array(
            'class' => 'filter_form_element_select chzn-select-deselect',
            'data-placeholder' => 'Тип'
        ));

        // Платформа
        $platform = new Element\Select('filter_platform');
        //$platform->setLabel('Платформа');
        $platform->setEmptyOption('');
        $platform->setValueOptions(array(
            'www' => 'WWW',
            'linux' => 'GNU/Linux',
            'android' => 'Android',
            'windows' => 'Windows',
        ));
        $platform->setAttributes(array(
            'class' => 'filter_form_element_select chzn-select-deselect',
            'data-placeholder' => 'Платформа'
        ));

        // Автор
        $author = new Element\Select('filter_author');
        //$author->setLabel('Автор');
        $author->setEmptyOption('');
        $author->setValueOptions(array(
            'jhekasoft' => 'Евгений Ефремов (Jhekasoft)',
            'sanekokokok' => 'Александр Дадыка',
            'yorik' => 'Юрий Исаев',
        ));
        $author->setAttributes(array(
            'class' => 'filter_form_element_select chzn-select-deselect',
            'data-placeholder' => 'Автор'
        ));

        // Submit
        $submit = new Element\Submit('filter_submit');
        $submit->setValue('Фильтровать');
        $submit->setAttribute('class', 'filter_form_submit');

        $this->add($type);
        $this->add($platform);
        $this->add($author);
        $this->add($submit);
    }

}
