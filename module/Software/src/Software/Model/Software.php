<?php

namespace Software\Model;

class Software
{
    public $id;
    public $name;
    public $title;
    public $version;
    public $author;
    public $short_text;
    public $text;
    public $image;
    public $file;

    public function exchangeArray($data)
    {
        $this->id          = (isset($data['id'])) ? $data['id'] : null;
        $this->name        = (isset($data['name'])) ? $data['name'] : null;
        $this->title       = (isset($data['title'])) ? $data['title'] : null;
        $this->version     = (isset($data['version'])) ? $data['version'] : null;
        $this->author      = (isset($data['author'])) ? $data['author'] : null;
        $this->short_text  = (isset($data['short_text'])) ? $data['short_text'] : null;
        $this->text        = (isset($data['text'])) ? $data['text'] : null;
        $this->image       = (isset($data['image'])) ? $data['image'] : null;
        $this->file        = (isset($data['file'])) ? $data['file'] : null;
    }
}
