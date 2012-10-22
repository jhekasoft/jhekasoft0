<?php

namespace Application\Model;

class FinalCountdownEmails
{
    public $id;
    public $datetime;
    public $ip;
    public $serverInfo;
    public $email;

    public function exchangeArray($data)
    {
        $this->id          = (isset($data['id'])) ? $data['id'] : null;
        $this->datetime    = (isset($data['datetime'])) ? $data['datetime'] : null;
        $this->ip          = (isset($data['ip'])) ? $data['ip'] : null;
        $this->serverInfo  = (isset($data['server_info'])) ? $data['server_info'] : null;
        $this->email       = (isset($data['email'])) ? $data['email'] : null;
    }
}
