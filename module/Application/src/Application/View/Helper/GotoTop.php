<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GotoTop extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();

        return $view->render('helper/goto-top');
    }
}
