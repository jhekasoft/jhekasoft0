<?php

namespace HMShortCode;

//use HMShortCode\Filter\ShortCodeFilter;

class Module
{

//    public function onBootstrap($e)
//    {
//        $app = $e->getApplication();
//        $em = $app->getEventManager();
//
//        $em->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, function($e) {
//            $match = $e->getRouteMatch();
//            $action = $match->getParam('action');
//
//            if ('edit' != $action) {
//                $sm = $e->getApplication()->getServiceManager();
//                $view = $sm->get('ViewRenderer');
//                $filters = $view->getFilterChain();
//                $widgetFilter = new ShortCodeFilter();
//                $widgetFilter->setServiceLocator($sm);
//                $filters->attach($widgetFilter, 50);
//                $view->setFilterChain($filters);
//            }
//        });
//    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php'),
            'Zend\Loader\StandardAutoloader' => array('namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                )),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}