<?php

namespace HMShortCode\Filter;

//use Zend\View\HelperPluginManager;
//use Zend\Mvc\Service\ViewHelperManagerFactory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Filter\AbstractFilter;
use Zend\Json\Json;

class ShortCodeFilter extends AbstractFilter implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    public function filter($value)
    {
        $matches = NULL;
        preg_match_all('/[{]{2}.+\[{0,1}.*\]{0,1}[}]{2}/', $value, $matches);
        foreach ($matches[0] as $match) {
            $value = str_replace($match, $this->convertMatchToHelper($match), $value);
        }

        $filtered = $value;

        return $filtered;
    }

    protected function convertMatchToHelper($match)
    {
        // Remove "{{" and "}}"
        $match = substr_replace($match, "", 0, 2);
        $match = substr_replace($match, "", -2, 2);

        $parts = explode("[", $match);

        // Helper method
        $helper = trim($parts[0]);

        unset($parts[0]);

        // Parameters
        $parameters = array();
        if (count($parts) > 0) {
            foreach ($parts as $part) {
                $data = substr_replace($part, "", -1);
                if ('{' == substr($data, 0, 1)) {
                    $parameters[] = Json::decode(html_entity_decode($data), Json::TYPE_ARRAY);
                } else {
                    $parameters[] = $data;
                }
            }
        }

        $view = $this->serviceLocator->get('ViewRenderer');

        ob_start();
        //echo $view->customHTML(array('title'=>'Custom Content Widgets!', 'content'=>'<p>This is some content in page content yo!</p>'));
        //echo $view->{$helper}($data);
        echo call_user_func_array(array($view, $helper), $parameters);
        $converted = ob_get_clean();

        return $converted;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

}
