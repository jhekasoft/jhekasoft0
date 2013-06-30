<?php

namespace Blog\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\JhekasoftController;
use Zend\View\Model\ViewModel;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;
//use Blog\Model\Blog;
use Blog\Form\BlogForm;

class BlogController extends JhekasoftController
{

    protected $itemTable;

    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);
        //$parent = $this->params()->fromRoute('parent', null);

        $paginator = $this->getTable()->getPaginator(array(
            'page' => $page,
            //'parent' => $parent,
            //'show' => 'all',
        ));

        return new ViewModel(array(
            'paginator' => $paginator,
            'can_edit' => $this->getAuthService()->hasIdentity(),
        ));
    }

    public function showAction()
    {
        $name = (string) $this->params()->fromRoute('name', null);

        $item = $this->getTable()->getItem($name, array(
            'field' => 'name',
        ));

        if (!$item) {
            throw new \Exception("Could not find row $name");
        }

        return array(
            'id' => $item->id,
            'item' => $item,
            'can_edit' => $this->getAuthService()->hasIdentity(),
        );
    }

    public function rssAction()
    {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\RendererInterface');
        $url = $this->plugin('url');
        $config = $this->getServiceLocator()->get('Config');

        $feed = new Feed;
        $feed->setTitle($config['settings']['sitename']);
        $feed->setDescription('Блог jhekasoft.net');
        $feed->setLink($url->fromRoute('home', array(), array('force_canonical' => true)));
        $feed->setFeedLink($url->fromRoute(null, array(), array('force_canonical' => true)), 'rss');
        $feed->addAuthor(array(
            'name'  => $config['settings']['sitename'],
            'email' => $config['settings']['email'],
            'uri'   => $url->fromRoute('home', array(), array('force_canonical' => true)),
        ));
        $feed->setDateModified(time());

        $items = $this->getTable()->fetchAll(array('limit' => 100));

        if (count($items) > 0) {
            foreach ($items as $item) {
                $datetime = new \DateTime($item->datetime);
                $content = $item->filtered_cut_text;
                if (!empty($item->image)) {
                    $content = '<img src="' . $renderer->basePath() . '/files/blog/images/p_' . $item->image . '" alt=""><br />' . $content;
                }
                $content .= '<br /><a class="blog_item_show_link" href="' . $url->fromRoute('blog/show', array('name' => $item->name), array('force_canonical' => true)) . '">Читать далее &rarr;</a>';

                $entry = $feed->createEntry();
                $entry->setTitle($item->title);
                $entry->setLink($url->fromRoute('blog/show', array('name' => $item->name), array('force_canonical' => true)));
                $entry->setDateModified($datetime->getTimestamp());
                $entry->setDateCreated($datetime->getTimestamp());
                //$entry->setDescription($item->title);
                $entry->setContent($content);
                $feed->addEntry($entry);
            }
        }

        //$out = $feed->export('rss');
        $feedmodel = new FeedModel();
        $feedmodel->setFeed($feed);

        return $feedmodel;
    }

    public function editAction()
    {
        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        $name = (string) $this->params()->fromRoute('name', null);
        if (!$name) {
            return $this->redirect()->toRoute('blog/add');
        }
        $item = $this->getTable()->getItem($name, array(
            'field' => 'name',
        ));

        if (!$item) {
            throw new \Exception("Could not find row $name");
        }

        $form = new BlogForm();
        $form->bind($item);
//        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($item->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $this->getTable()->saveItem($data);

                // Redirect to list of albums
                return $this->redirect()->toRoute('blog/show', array('name' => $data->name));
            }
        }

        return array(
            'id' => $item->id,
            'item' => $item,
            'form' => $form,
        );
    }

    public function addAction()
    {
        if (!$this->getAuthService()->hasIdentity()) {
            throw new \Exception("Not found.");
        }

        $form = new BlogForm();
        //$form->bind($item);
        $form->get('submit')->setAttribute('value', 'Добавить');

        $item = $this->getServiceLocator()->get('Blog\Model\Blog');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($item->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $item->exchangeArray($form->getData());

                // автоматическая дата (если поле пустое)
                if (empty($item->datetime)) {
                    $item->datetime = date('Y-m-d H:i:s', time());
                }

                $item->show = 'yes';
                $this->getTable()->saveItem($item);

                // Redirect to list of albums
                return $this->redirect()->toRoute('blog/show', array('name' => $item->name));
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function getTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Blog\Model\BlogTable');
        }

        return $this->itemTable;
    }

}
