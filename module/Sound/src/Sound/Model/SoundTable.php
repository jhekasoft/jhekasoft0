<?php

namespace Sound\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;

class SoundTable extends AbstractTableGateway
{
    protected $table ='jh_sound';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Sound());

        $this->initialize();
    }

    public function fetchAll($options = array())
    {
        $where = array();

        $select = $this->getSql()->select();
        $select->where($where)->order('datetime DESC');

        $resultSet = $this->selectWith($select);
        $resultSet->buffer();
        $resultSet->current();

        return $resultSet;
    }

    public function getPaginator($options = array())
    {
        $page = 1;
        $countPerPage = 10;

        if (!empty($options['page'])) {
            $page = (int) $options['page'];
        }
        if (!empty($options['countPerPage'])) {
            $countPerPage = (int) $options['countPerPage'];
        }

        $iteratorAdapter = new Iterator($this->fetchAll($options));
        $paginator = new Paginator($iteratorAdapter);

        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($countPerPage);

        return $paginator;
    }

    public function getItem($id, $options = array())
    {
        $fieldName = 'id';

        if (!empty($options['field'])) {
            $fieldName = $options['field'];
        }

        $rowset = $this->select(array(
            $fieldName => $id,
        ));

        $row = $rowset->current();

        return $row;
    }

    public function saveItem(Sound $item)
    {
        $data = array(
            'name' => $item->name,
            'datetime'  => $item->datetime,
            'author'  => $item->author,
            'title'  => $item->title,
            'lyrics'  => $item->lyrics,
            'file' => $item->file,
            'file2' => $item->file2,
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

//    public function deleteItem($id)
//    {
//        $this->delete(array(
//            'id' => $id,
//        ));
//    }
}
