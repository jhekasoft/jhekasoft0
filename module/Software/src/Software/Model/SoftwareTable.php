<?php

namespace Software\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class SoftwareTable extends AbstractTableGateway
{
    protected $table ='jh_software';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Software());

        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getItem($id, $options = array())
    {
        $fieldName = 'id';
        
        if(!empty($options['field'])) {
            $fieldName = $options['field'];
        }

        $rowset = $this->select(array(
            $fieldName => $id,
        ));

        $row = $rowset->current();

        return $row;
    }

    public function saveItem(Software $item)
    {
        $data = array(
            'artist' => $item->artist,
            'title'  => $item->title,
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

    public function deleteItem($id)
    {
        $this->delete(array(
            'id' => $id,
        ));
    }
}
