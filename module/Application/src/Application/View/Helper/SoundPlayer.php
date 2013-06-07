<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SoundPlayer extends AbstractHelper
{
    public function __invoke($url)
    {
        $view = $this->getView();

        $view->url = $url;

        return $view->render('helper/sound-player');
    }
}
