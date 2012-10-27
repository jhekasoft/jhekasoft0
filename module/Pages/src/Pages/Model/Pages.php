<?php

namespace Pages\Model;

class Pages
{
    public $id;
    public $name;
    public $title;
    public $author;
    public $text;
    public $image;
    public $showComments;

    public function exchangeArray($data)
    {
        $this->id              = (isset($data['id'])) ? $data['id'] : null;
        $this->name            = (isset($data['name'])) ? $data['name'] : null;
        $this->title           = (isset($data['title'])) ? $data['title'] : null;
        $this->author          = (isset($data['author'])) ? $data['author'] : null;
        $this->text            = (isset($data['text'])) ? $data['text'] : null;
        $this->image           = (isset($data['image'])) ? $data['image'] : null;
        $this->type            = (isset($data['type'])) ? $data['type'] : null;
        $this->showComments    = (isset($data['show_comments'])) ? $data['show_comments'] : null;
    }
}
