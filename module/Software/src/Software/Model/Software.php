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
    public $type;
    public $authorId;
    public $platformLinux;
    public $platformAndroid;
    public $platformWww;
    public $meta_keywords;
    public $meta_description_default;

    public $typeTitle;
    public $platformTitles = array();
    public $authorTitle;

    public function exchangeArray($data)
    {
        $this->id              = (isset($data['id'])) ? $data['id'] : null;
        $this->name            = (isset($data['name'])) ? $data['name'] : null;
        $this->title           = (isset($data['title'])) ? $data['title'] : null;
        $this->version         = (isset($data['version'])) ? $data['version'] : null;
        $this->author          = (isset($data['author'])) ? $data['author'] : null;
        $this->short_text      = (isset($data['short_text'])) ? $data['short_text'] : null;
        $this->text            = (isset($data['text'])) ? $data['text'] : null;
        $this->image           = (isset($data['image'])) ? $data['image'] : null;
        $this->file            = (isset($data['file'])) ? $data['file'] : null;
        $this->type            = (isset($data['type'])) ? $data['type'] : null;
        $this->authorId        = (isset($data['author_id'])) ? $data['author_id'] : null;
        $this->platformLinux   = (isset($data['platform_linux'])) ? $data['platform_linux'] : null;
        $this->platformAndroid = (isset($data['platform_android'])) ? $data['platform_android'] : null;
        $this->platformWww     = (isset($data['platform_www'])) ? $data['platform_www'] : null;
        $this->platformWindows = (isset($data['platform_windows'])) ? $data['platform_windows'] : null;
        $this->meta_keywords    = (isset($data['meta_keywords'])) ? $data['meta_keywords'] : null;

        $meta_description = mb_substr(strip_tags($this->text), 0, 200, 'utf-8');
        $this->meta_description_default = str_replace(array("\n", "\r"), "", $meta_description) . '...';

        // Подпись типа приложения
        switch ($data['type']) {
            case 'game':
                $this->typeTitle = 'Игра';
                break;
            case 'software':
            default:
                $this->typeTitle = 'Приложение';
        }

        // Подписи платформ
        if ($data['platform_linux']) {
            $this->platformTitles['linux'] = 'Linux';
        }
        if ($data['platform_windows']) {
            $this->platformTitles['windows'] = 'Windows';
        }
        if ($data['platform_android']) {
            $this->platformTitles['android'] = 'Android';
        }
        if ($data['platform_www']) {
            $this->platformTitles['www'] = 'WWW';
        }

        // Подпись автора
        switch ($data['author_id']) {
            case 2:
                $this->authorTitle = 'Александр Дадыка';
                break;
            case 3:
                $this->authorTitle = 'Юрий Исаев';
                break;
            case 1:
            default:
                $this->authorTitle = 'Евгений Ефремов (Jhekasoft)';
        }
    }
}
