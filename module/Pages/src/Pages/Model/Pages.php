<?php

namespace Pages\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Pages implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $parId;
    public $title;
    public $author;
    public $text;
    public $image;
    public $showComments;
    
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id              = (isset($data['id'])) ? $data['id'] : null;
        $this->name            = (isset($data['name'])) ? $data['name'] : null;
        $this->parId           = (isset($data['par_id'])) ? $data['par_id'] : null;
        $this->title           = (isset($data['title'])) ? $data['title'] : null;
        $this->author          = (isset($data['author'])) ? $data['author'] : null;
        $this->text            = (isset($data['text'])) ? $data['text'] : null;
        $this->image           = (isset($data['image'])) ? $data['image'] : null;
        $this->type            = (isset($data['type'])) ? $data['type'] : null;
        $this->showComments    = (isset($data['show_comments'])) ? $data['show_comments'] : null;
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
