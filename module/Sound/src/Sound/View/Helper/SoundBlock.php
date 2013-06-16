<?php

namespace Sound\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SoundBlock extends AbstractHelper implements ServiceLocatorAwareInterface
{
    public function __invoke($name, array $options = array())
    {
        $view = $this->getView();

        $item = $this->getTable()->getItem($name, array(
            'field' => 'name',
        ));

        $view->item = $item;

        if (isset($options['size']) && 'small' == $options['size']) {
            return $view->render('helper/sound-block-small');
        }
        return $view->render('helper/sound-block');
    }

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getTable()
    {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator()->getServiceLocator();
            $this->itemTable = $sm->get('Sound\Model\SoundTable');
        }

        return $this->itemTable;
    }
}
