<?php

namespace Auth\Model;

use Zend\Db\TableGateway\AbstractTableGateway;

class UserTable extends AbstractTableGateway
{
    protected $table ='jh_user';

    public function getTableName()
    {
        return $this->table;
    }
}
