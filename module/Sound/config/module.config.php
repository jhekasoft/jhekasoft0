<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Sound\Controller\Sound' => 'Sound\Controller\SoundController',
        ),
    ),

//    'router' => array(
//        'routes' => array(
//            'sounds' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    'route'    => '/sound',
//                    'defaults' => array(
//                        'controller' => 'Sound\Controller\Sound',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
//        ),
//    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'sound' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'sound_block' => 'Sound\View\Helper\SoundBlock',
        )
    ),
);
