<?php

namespace Software\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;

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

    public function fetchAll($options = array())
    {
        $where = array();

        // Условие отображаемых строк
        // Варианты: yes, no, all. По умолчанию yes
        // Если all, то не добавляем условие
        $show = 'yes';
        if (!empty($options['show'])) {
            $show = $options['show'];
        }
        if ($show != 'all') {
            $where[] = "`show` = '{$show}'";
        }

        // Тип приложения
        $type = 'all';
        if (!empty($options['type'])) {
            switch ($options['type']) {
                case 'game':
                    $type = 'game';
                    break;
                case 'software':
                default:
                    $type = 'software';
                    break;
            }
        }
        if ($type != 'all') {
            $where[] = "`type` = '{$type}'";
        }

        // Платформа
        $platform = 'all';
        if (!empty($options['platform'])) {
            switch ($options['platform']) {
                case 'linux':
                    $platform = 'linux';
                    break;
                case 'windows':
                    $platform = 'windows';
                    break;
                case 'android':
                    $platform = 'android';
                    break;
                case 'www':
                default:
                    $platform = 'www';
                    break;
            }
        }
        if ($platform != 'all') {
            $where[] = "`platform_{$platform}` = '1'";
        }

        // Автор
        $authorId = 'all';
        if (!empty($options['author'])) {
            switch ($options['author']) {
                case 'sanekokokok':
                    $authorId = 2;
                    break;
                case 'yorik':
                    $authorId = 3;
                    break;
                case 'jhekasoft':
                default:
                    $authorId = 1;
                    break;
            }
        }
        if ($authorId != 'all') {
            $where[] = "`author_id` = '{$authorId}'";
        }

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

        if (!empty($options['page'])) {
            $page = (int) $options['page'];
        }

        $iteratorAdapter = new Iterator($this->fetchAll($options));
        $paginator = new Paginator($iteratorAdapter);

        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);

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

//    public function saveItem(Software $item)
//    {
//        $data = array(
//            'artist' => $item->artist,
//            'title'  => $item->title,
//        );
//
//        $id = (int) $item->id;
//
//        if ($id == 0) {
//            $this->insert($data);
//        } elseif ($this->getItem($id)) {
//            $this->update(
//                $data,
//                array(
//                    'id' => $id,
//                )
//            );
//        } else {
//            throw new \Exception('Form id does not exist');
//        }
//    }
//
//    public function deleteItem($id)
//    {
//        $this->delete(array(
//            'id' => $id,
//        ));
//    }
}
