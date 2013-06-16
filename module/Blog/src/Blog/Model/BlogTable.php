<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;
use Zend\ServiceManager\ServiceManager;

class BlogTable extends AbstractTableGateway
{
    protected $table ='jh_blog';
    protected $serviceManager;

    public function __construct(Adapter $adapter, ServiceManager $serviceManager)
    {
        $this->adapter = $adapter;
        $this->serviceManager = $serviceManager;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(
            $this->serviceManager->get('Blog\Model\Blog')
        );
        //$this->resultSetPrototype->setArrayObjectPrototype(new Blog());

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

        // Родительская страница
        $par_id = 'all';
        if (!empty($options['parent'])) {
            $parentItem = $this->getItem($options['parent'], array(
                'field' => 'name',
            ));

            if ($parentItem) {
                $par_id = $parentItem->id;
            }
        }
        if ($par_id != 'all') {
            $where[] = "`par_id` = '{$par_id}'";
        }

        $select = $this->getSql()->select();
        $select->where($where)->order('datetime DESC');

        $resultSet = $this->selectWith($select);
        $resultSet->buffer();
        $resultSet->next();

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

    public function saveItem(Blog $item)
    {
        $data = array(
            'name' => $item->name,
            'datetime'  => $item->datetime,
            'title'  => $item->title,
            'cut_text'  => $item->cut_text,
            'text'  => $item->text,
            'meta_keywords'  => $item->meta_keywords,
            'show_comments'  => $item->show_comments,
            'image' => $item->image,
        );

        if (!empty($item->show)) {
            $data['show'] = $item->show;
        }

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
