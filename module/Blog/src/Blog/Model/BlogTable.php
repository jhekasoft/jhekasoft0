<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;

class BlogTable extends AbstractTableGateway
{
    protected $table ='jh_page';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Blog());

        $this->initialize();
    }

    public function fetchAll($options = array())
    {
        $where = array();
        
        // Условие отображаемых строк
        // Варианты: yes, no, all. По умолчанию yes
        // Если all, то не добавляем условие
        $show = 'yes';
        if(!empty($options['show'])) {
            $show = $options['show'];
        }
        if($show != 'all') {
            $where[] = "`show` = '{$show}'";
        }
        
        // Родительская страница
        $par_id = 'all';
        if(!empty($options['parent'])) {
            $parentItem = $this->getItem($options['parent'], array(
                'field' => 'name',
            ));
            
            if($parentItem) {
                $par_id = $parentItem->id;
            }
        }
        if($par_id != 'all') {
            $where[] = "`par_id` = '{$par_id}'";
        }
        
        $resultSet = $this->select($where);
        $resultSet->buffer();
        $resultSet->next();
        
        return $resultSet;
    }
    
    public function getPaginator($options = array())
    {
        $page = 1;
        
        if(!empty($options['page'])) {
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
        
        if(!empty($options['field'])) {
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
            'text'  => $item->text,
            'show'  => $item->show,
            'meta_keywords'  => $item->meta_keywords,
            'show_share'  => $item->show_share,
            'show_comments'  => $item->show_comments,
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
