<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ShareBlock extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();

        return $view->render('helper/share-block');
    }
}
