<?php

namespace Blog\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Blog implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $datetime;
    public $title;
    public $cut_text;
    public $text;
    public $image;
    public $show;
    public $show_comments;
    public $meta_keywords;
    public $meta_description_default;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id              = (isset($data['id'])) ? $data['id'] : null;
        $this->name            = (isset($data['name'])) ? $data['name'] : null;
        $this->title           = (isset($data['title'])) ? $data['title'] : null;
        $this->datetime        = (isset($data['datetime'])) ? $data['datetime'] : null;
        $this->cut_text        = (isset($data['cut_text'])) ? $data['cut_text'] : null;
        $this->text            = (isset($data['text'])) ? $data['text'] : null;
        $this->image           = (isset($data['image'])) ? $data['image'] : null;
        $this->show            = (isset($data['show'])) ? $data['show'] : null;
        $this->show_comments   = (isset($data['show_comments'])) ? $data['show_comments'] : null;
        $this->meta_keywords   = (isset($data['meta_keywords'])) ? $data['meta_keywords'] : null;

        $meta_description = mb_substr(strip_tags($this->text), 0, 200, 'utf-8');
        $this->meta_description_default = str_replace(array("\n", "\r"), "", $meta_description) . '...';
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'meta_keywords',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
