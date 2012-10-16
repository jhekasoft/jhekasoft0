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

    public function getSoftware($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveSoftware(Software $software)
    {
        $data = array(
            'artist' => $software->artist,
            'title'  => $software->title,
        );

        $id = (int) $software->id;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getSoftware($id)) {
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

    public function deleteSoftware($id)
    {
        $this->delete(array(
            'id' => $id,
        ));
    }
}
