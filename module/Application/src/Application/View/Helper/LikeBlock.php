<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class LikeBlock extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();

        return $view->render('helper/like-block');
    }
}
