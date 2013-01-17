<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;

class FinalCountdownEmailsTable extends AbstractTableGateway
{
    protected $table ='jh_final_countdown_email';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new FinalCountdownEmails());

        $this->initialize();
    }

//    public function fetchAll($options = array())
//    {
//        $where = array();
//
//        $resultSet = $this->select($where);
//        $resultSet->buffer();
//        $resultSet->next();
//
//        return $resultSet;
//    }
//
//    public function getPaginator($options = array())
//    {
//        $page = 1;
//
//        if (!empty($options['page'])) {
//            $page = (int) $options['page'];
//        }
//
//        $iteratorAdapter = new Iterator($this->fetchAll($options));
//        $paginator = new Paginator($iteratorAdapter);
//
//        $paginator->setCurrentPageNumber($page);
//        $paginator->setItemCountPerPage(1);
//
//        return $paginator;
//    }
//
//    public function getItem($id, $options = array())
//    {
//        $fieldName = 'id';
//
//        if (!empty($options['field'])) {
//            $fieldName = $options['field'];
//        }
//
//        $rowset = $this->select(array(
//            $fieldName => $id,
//        ));
//
//        $row = $rowset->current();
//
//        return $row;
//    }

    public function saveItem(FinalCountdownEmails $item)
    {
        $data = array(
            'datetime' => $item->datetime,
            'ip' => $item->ip,
            'server_info'  => $item->serverInfo,
            'email'  => $item->email,
        );

        $id = (int) $item->id;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getItem($id)) {
            $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
    }
//
//    public function deleteItem($id)
//    {
//        $this->delete(array(
//            'id' => $id,
//        ));
//    }
}
